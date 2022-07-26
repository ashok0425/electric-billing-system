<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Country;
use App\Models\District;
use App\Models\State;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\services\UserService;
use Illuminate\Support\Facades\Auth;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
class UserDetailController extends Controller
{
public $UserService;
    public function __construct(UserService $UserService)
    {
        $this->UserService=$UserService;
    }


// upload via excel 

 public function excelupload(Request $request)
{
    Excel::import(new UsersImport, $request->file('file'));
        dd('user');
    return redirect('/')->with('success', 'All good!');
}


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      
        if($request->ajax()){
            if(Auth::guard('admin')->user()->type=='franchise'){
                $users=UserDetail::join('users','user_details.user_id','users.id')->select('user_details.id','users.email','users.created_at','users.name','users.status','user_details.phone1','user_details.citizenship_no','users.status')->orderBy('users.id','desc')->where('users.franchise_id',Auth::guard('admin')->user()->id)->get();
            }else{

            $users=UserDetail::join('users','user_details.user_id','users.id')->select('user_details.id','users.email','users.created_at','users.name','users.status','user_details.phone1','user_details.citizenship_no','users.status')->orderBy('users.id','desc')->get();
        }

            return Datatables::of($users)
            ->editColumn('created_at','{{__getNepaliDate($created_at,1)}}')
            ->editColumn('status',function($row){
                if ($row->status==0) {
                    return '<div class="badge bg-danger text-white">pending</div>';
                }elseif($row->status==1){
                    return '<div class="badge bg-success text-white">Active</div>';
                }
                else{
                    return '<div class="badge bg-primary text-white">Blocked</div>';
                }
            })

            ->addColumn('action',function($row){
                $html='
              <div class="d-flex justify-content-center">
              <a href="'.route('admin.user_details.edit',$row->id).'" class="btn btn-primary"><i class="fa fa-edit"></i></a>
              <a href="'.route('admin.user_details.show',$row->id).'"  class=" btn btn-primary">
            <i class="fa fa-eye"></i>

              </a>

      
              </div>';
                return $html;
            }
            )
            ->rawColumns(['status','action'])
            ->make(true);

        }
        return view('admin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $countries=Country::all();
       $states=State::all();
       $franchises =Admin::all();

      return view('admin.user.create',compact('countries','states','franchises'));

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
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
            // 'phone1'=>'required',
            // 'citizenship_no'=>'required',
            // 'address'=>'required',
    
        ]);
        $this->UserService->CreateOrupdate($request);

        try {
            //code...
        
        $notification=[
            'alert-type'=>'success',
             'messege'=>'Added successfully'
        ];

    } catch (\Throwable $th) {

        $notification=[
            'alert-type'=>'error',
             'messege'=>'Failed to update.Try again'
        ];
    }

    return redirect()->route('admin.user_details.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserDetail  $userDetail
     * @return \Illuminate\Http\Response
     */
    public function show(UserDetail $userDetail)
    {
        $user=User::with('detail')->first();
        $franchises =Admin::all();

        return view('admin.user.show',compact('user','franchises'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserDetail  $userDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(UserDetail $userDetail)
    {
        $countries=Country::all();
        $districts=District::all();
        $franchises =Admin::all();

        $states=State::all();
        $user=User::with('detail')->where('id',$userDetail->user_id)->first();
       return view('admin.user.edit',compact('countries','states','user','districts','franchises'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserDetail  $userDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserDetail $UserDetail)
    {

        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'phone1'=>'required',
            'citizenship_no'=>'required',
            'address'=>'required',
    
        ]);
        try {
            //code...
            $this->UserService->CreateOrupdate($request,$UserDetail->user_id);
        
        $notification=[
            'alert-type'=>'success',
             'messege'=>'Updated successfully'
        ];

    } catch (\Throwable $th) {
        $notification=[
            'alert-type'=>'error',
             'messege'=>'Failed to update.Try again'
        ];
    }

    return redirect()->route('admin.user_details.index')->with($notification);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserDetail  $userDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserDetail $userDetail)
    {
        //
    }

    public function district(Request $request)
    {
        $districts=District::where('state_id',$request->id)->get();
        $data='';
        foreach ($districts as $value) {
           $data .=" <option value='$value->id'>$value->name</option>";
        }
        return response()->json($data);
    }



    public function meterList(Request $request)
    {
      
        if($request->ajax()){  
            if(Auth::guard('admin')->user()->type=='franchise'){

            $users=User::orderBy('id','desc')->where('franchise_id',Auth::guard('admin')->user()->id)->get();
            }else{
            $users=User::orderBy('id','desc')->get();

            }
            return Datatables::of($users)
            ->editColumn('created_at','{{__getNepaliDate($created_at,1)}}')
            ->editColumn('transfer_to',function($row){
                if($row->user){
                    $html=$row->user->name.'<br> C_No: '.$row->user->costumer_id;
                   $html.='<br><a href="'.route('admin.user_details.show',$row->detail->id).'" class="btn btn-primary"><i class="fas fa-eye"></i></a>';
                   return $html;
                }
            })

            ->editColumn('is_transfered',function($row){
                if ($row->is_transfered==0) {
                    return '<div class="badge bg-primary text-white">No</div>';
                }else{
                    return '<div class="badge bg-success text-white">yes</div>';

                }
                
            })

            ->addColumn('customer',function($row){
                $html=$row->name.'<br> C_No: '.$row->costumer_id;

                $html.='<br> <a href="'.route('admin.user_details.show',$row->detail->id).'" class="btn btn-primary"><i class="fas fa-eye"></i></a>';
                return $html;
            })

            ->addColumn('action',function($row){

                $html=' <a href="'.route('admin.transfer_meters.transfer',$row->id).'"  data-toggle="tooltip" data-placement="top" title="Tooltip on top" class="btn btn-primary">Transfer</a>';
                $html.=' <a href="'.route('admin.consume_units.print',$row->id).'" class="btn btn-primary">print</a>';

                $html.=' <a href="'.route('admin.accounts.payment',$row->id).'" class="btn btn-primary">Bill history</a>';
                $html.='   <a href="'.route('admin.user_details.pay',$row->id).'"  class=" btn btn-primary">Make payment</i>
  </a>';
                return $html;
            }
            )
            ->rawColumns(['customer','is_transfered','transfer_to','action'])
            ->make(true);

        }
        return view('admin.user.meter');
    }






}
