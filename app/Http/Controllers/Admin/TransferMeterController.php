<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\ConsumeUnit;
use App\Models\TransferMeter;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class TransferMeterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $units=TransferMeter::orderBy('id','desc')->get();

            return DataTables::of($units)
            ->addColumn('transfer_from',function($row){
                return $row->user->name .'<br>Customer Id:'. $row->user->costumer_id;
            })

            ->addColumn('transfer_to',function($row){
                return $row->users->name .'<br>Customer Id:'. $row->users->costumer_id;
            })

            ->editColumn('created_at',function($row){
                $html= __getNepaliDate($row->created_at,1);
              
                return $html;
            })

            ->rawColumns(['transfer_from','transfer_to'])
            ->make(true);

        }
return view('admin.transfer_meter.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id=null)
    {
        $users=User::all();
        $current_unit=ConsumeUnit::where('user_id',$id)->latest()->first();
        return view('admin.transfer_meter.create',compact('users','id','current_unit'));

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
            'transfer_to'=>'required',
            'total_unit'=>'required',
            'meter_id'=>'required',
            'transfer_amount'=>'required',
        ]);

        // try {
            $user=User::where('id',$request->meter_id)->first();
            DB::beginTransaction();
           $account=new TransferMeter();
           $account->transfer_from=$user->id;
           $account->transfer_to=$request->transfer_to;
           $account->total_unit=$request->total_unit;
           $account->meter_id=$user->meter_id;
           $account->transfer_amount=$request->transfer_amount;
           $account->remark=$request->remark;
           $account->save();
           $user->is_transfered=1;
           $user->transfer_to=$request->transfer_to;
           $user->save();
           ConsumeUnit::where('user_id',$user->id)->update(['user_id'=>$request->transfer_to]);
           Account::where('user_id',$user->id)->update(['user_id'=>$request->transfer_to]);
           DB::commit();

            $notification=[
                'alert-type'=>'success',
                 'messege'=>'Created successfully'
            ];

        // } catch (\Throwable $th) {
           DB::rollback();

        //     $notification=[
        //         'alert-type'=>'error',
        //          'messege'=>'Something went wrong.Please try again later'
        //     ];
        // }
        return redirect()->back()->with($notification);
   
    }

    public function loadUnit(Request $request){

      $last_reading=  ConsumeUnit::join('users','users.id','consume_units.user_id')->where('user_id',$request->id)->orderBy('consume_units.id','desc')->select('consume_units.unit','users.meter_id')->latest('consume_units.created_at')->first();
      if($last_reading){
return response($last_reading);
      }else{
        return response(0);

      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function edit(Account $account)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Account $account)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        //
    }
}
