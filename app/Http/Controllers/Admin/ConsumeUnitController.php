<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\ConsumeUnit;
use App\Models\UnitCharge;
use App\Models\User;
use App\services\ConsumeUnitService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
class ConsumeUnitController extends Controller
{

    public $ConsumeUnitService;
    public function __construct(ConsumeUnitService $ConsumeUnitService)
    {
        $this->ConsumeUnitService=$ConsumeUnitService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $units=ConsumeUnit::with('user')->orderBy('created_at','desc')->get();
        if($request->ajax()){
            if(Auth::guard('admin')->user()->type=='franchise'){

                $units=ConsumeUnit::whereHas('user',function($q){
                    $q->where('franchise_id','=',Auth::guard('admin')->user()->id);
                })->orderBy('created_at','desc')->get();
            }else{
                $units=ConsumeUnit::with('user')->orderBy('created_at','desc')->get();

            }
            return Datatables::of($units)
          
            ->addColumn('customer',function($row){
                return $row->user->meter_id;
            })
->addColumn('fine',function($row){
return __fine($row->created_at,today(),$row->price);

})

->addColumn('due',function($row){
     $data=__dueDate($row->created_at,today()).'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        $data.= __getNepaliDate($row->created_at,1);
        return $data;
    
    })

 
            ->addColumn('month',function($row){
                $html= __getNepaliDate($row->from);
                $html.='↔';
                $html .=__getNepaliDate($row->to);
                return $html;
            })

            ->editColumn('status',function($row){
                if ($row->status==0) {
                    $html='<a href="" class="badge bg-danger modal-btn text-white">unpaid</a>';

                }
                if ($row->status==1) {
                    $html='<a href="" class="badge bg-success modal-btn text-white">paid</a>';

                }
                if ($row->status==2) {
                    $html='<a href="" class="badge bg-primary modal-btn text-white">partial paid</a>';

                }
                return $html;
            })

            ->editColumn('to','{{__getNepaliDate($to)}}')

            

            ->addColumn('action',function($row){
                $html='
              <div class="d-flex justify-content-center">
              <a href="'.route('admin.consume_units.edit',$row->id).'" class="btn btn-primary"><i class="fa fa-edit"></i></a>
    
              </div>';
                return $html;
            }
            )
            ->rawColumns(['customer','month','action','status','due'])
            ->make(true);

        }
return view('admin.consume_unit.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::guard('admin')->user()->type=='franchise')
        {
            $users=User::where('franchise_id',Auth::guard('admin')->user()->id)->get();


        }else{
            $users=User::all();

        }

        return view('admin.consume_unit.create',compact('users'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'from'=>'required',
            'to'=>'required',
            'user'=>'required',


        ]);
        $this->ConsumeUnitService->CreateOrUpdate($request);

        try {
           

            $notification=[
                'alert-type'=>'success',
                 'messege'=>'Created successfully'
            ];
            if($request->print==1){
                return redirect()->route('admin.consume_units.print',['id'=>$request->user])->with($notification);
            }

        } catch (\Throwable $th) {
            $notification=[
                'alert-type'=>'error',
                 'messege'=>'Something went wrong.Please try again later'
            ];
        }
        return redirect()->back()->with($notification);
   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ConsumeUnit $District
     * @return \Illuminate\Http\Response
     */
    public function show(ConsumeUnit $ConsumeUnit)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ConsumeUnit $District
     * @return \Illuminate\Http\Response
     */
    public function edit(ConsumeUnit $ConsumeUnit)
    {
        $unit=ConsumeUnit::find($ConsumeUnit->id);
        $users=User::all();

        return view('admin.consume_unit.edit',compact('unit','users'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ConsumeUnit $District
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ConsumeUnit $ConsumeUnit)
    {
        $this->ConsumeUnitService->CreateOrUpdate($request,$ConsumeUnit->id);

        $request->validate([
            'from'=>'required',
            'to'=>'required',
            'user'=>'required',
        ]);
        try {
            $notification=[
                'alert-type'=>'success',
                 'messege'=>'Updated successfully'
            ];
        } catch (\Throwable $th) {
            $notification=[
                'alert-type'=>'error',
                 'messege'=>'Something went wrong.Please try again later'
            ];
        }
        return redirect()->route('admin.consume_units.index')->with($notification);
   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ConsumeUnit $District
     * @return \Illuminate\Http\Response
     */
    public function destroy(ConsumeUnit $ConsumeUnit,$id)
    {
        try {
            $unit=ConsumeUnit::where('id',$id)->first();
            $unit->delete();
            $notification=[
                'alert-type'=>'success',
                 'messege'=>'Delete successfully'
            ];
        } catch (\Throwable $th) {
            $notification=[
                'alert-type'=>'error',
                 'messege'=>'Something went wrong.Please try again later'
            ];
        }
        return redirect()->back()->with($notification);
   

    }

public function loadlastmeter(Request $request){
    $last_reading=  ConsumeUnit::where('user_id',$request->id)->orderBy('id','desc')->latest()->first();
    if($last_reading){
return response($last_reading->current_total_unit);
    }else{
      return response(0);

    }

}

public function print($id){
    $units=ConsumeUnit::where('user_id',$id)->where('status',0)->get();
    $current=ConsumeUnit::where('user_id',$id)->latest()->first();

    $fine=0;
    $price=0;
       foreach($units as $value){
        $fine+=__fine($value->created_at,today(),$value->price);
        $price+=$value->price;

       }
       if($current==null){
        $notification=[
            'alert-type'=>'error',
             'messege'=>'No Meter reading'
        ];
    return redirect()->back()->with($notification);
       }
return view('invoice.meter_reaading',compact('price','fine','current'));
}
}
