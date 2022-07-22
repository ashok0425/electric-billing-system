<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\Country;
use App\Models\District;
use App\Models\FranchiseDetail;
use App\Models\State;
use Yajra\DataTables\Facades\DataTables;

class AuthController extends Controller
{


 

 public function login(){
      return view('frontend.auth.login');
 }

public function loginStore(Request $request){

      $request->validate([
        'email'=>'required|email',
        'password'=>'required',

      ]);

      if(!Auth::attempt($request->only(['email','password']))){
        $notification=[
            'alert-type'=>'error',
             'messege'=>'Invalid credientials'
        ];
        return redirect()->back()->with($notification);
      }
      return redirect()->route('dashboard');


    }

         public function dashboard(){
            return view('frontend.auth.dashboard');
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
