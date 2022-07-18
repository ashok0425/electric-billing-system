<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\Country;
use App\Models\District;
use App\Models\FranchiseDetail;
use App\Models\State;
use Yajra\DataTables\Facades\DataTables;
use App\services\FranchiseService;

class AuthController extends Controller
{


  
  public $FranchiseService;
  public function __construct(FranchiseService $FranchiseService)
  {
      $this->FranchiseService=$FranchiseService;
  }

 public function login(){
      return view('admin.auth.login');
 }

public function loginStore(Request $request){


      $request->validate([
        'email'=>'required|email',
        'password'=>'required',

      ]);

      if(!Auth::guard('admin')->attempt($request->only('email','password'))){
        $notification=[
            'alert-type'=>'error',
             'messege'=>'Invalid credientials'
        ];
        return redirect()->back()->with($notification);
      }
      return redirect()->route('admin.dashboard');


    }




    public function index(Request $request){
      if($request->ajax()){
        $users=FranchiseDetail::join('admins','franchise_details.admin_id','admins.id')->select('franchise_details.id','franchise_details.admin_id','admins.email','admins.created_at','admins.name','admins.status','franchise_details.phone1','franchise_details.citizenship_no','admins.status')->where('admins.type','franchise')->orderBy('admins.id','desc')->get();
        return DataTables::of($users)
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
          <a href="'.route('admin.franchises.edit',$row->admin_id).'" class="btn btn-primary"><i class="fa fa-edit"></i></a>
          <a href="'.route('admin.franchises.show',$row->admin_id).'"  class=" btn btn-primary">
        <i class="fa fa-eye"></i>
          </a>
          </div>';
            return $html;
        }
        )
        ->rawColumns(['status','action'])
        ->make(true);

    }

    return view('admin.franchise.index');
   }

         public function dashboard(){
            return view('admin.dashboard');
         }

         public function logout(){
          Auth::logout();
          return redirect()->route('admin.login');
         }

         public function setup(){
          return view('admin.primary_setup.index');
       }



       public function create(){
        $countries=Country::all();
        $states=State::all();
       return view('admin.franchise.create',compact('countries','states'));
       }

       
       public function store(Request $request){
        $request->validate([
          'name'=>'required',
          'email'=>'required|email|unique:users,email',
          'phone1'=>'required',
          'citizenship_no'=>'required',
          'address'=>'required',
          'password'=>'required',
          'confirm_password'=>'required|same:password'
  
      ]);

      try {
          //code...
          $this->FranchiseService->CreateOrupdate($request);
      
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

  return redirect()->route('admin.franchises.index')->with($notification);
       }


       public function edit($id){
        $countries=Country::all();
        $districts=District::all();
        $states=State::all();

        $user=Admin::with('detail')->where('id',$id)->where('type','franchise')->first();
        return view('admin.franchise.edit',compact('countries','districts','states','user'));
       }

       public function update(Request $request,$id){
      $this->FranchiseService->CreateOrupdate($request,$id);

        if($id!=Auth::guard('admin')->user()->id){
            $request->validate([
                'name'=>'required',
                'email'=>'required',
                'phone1'=>'required',
                'citizenship_no'=>'required',
                'address'=>'required',
        
            ]);
        }
     

      try {
          //code...
      
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

  return redirect()->back()->with($notification);
       }

        public function profile()
       {
         return view('admin.profile');
       }
}
