<?php
namespace App\services;

use App\Models\Admin;
use App\Models\FranchiseDetail;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class FranchiseService {


public function CreateOrUpdate(Request $request,$id=null){

 
DB::beginTransaction();
if($id!=null){
    $user=Admin::find($id);

}else{
    $user=new Admin;
$user->type=='franchise';
   
}
$user->name=$request->name;
$user->email=$request->email;
$user->status=$request->status;
if ($request->password!=null) {
    $user->password=Hash::make($request->password);
}
$user->save();

if(Auth::guard('admin')->user()->id==$id){
    DB::commit();
if ($request->password!=null) {
    Auth::logout();
return redirect()->route('admin.login');
}
return true;
}
    if($id!=null){
        $user_detail=FranchiseDetail::where('admin_id',$id)->first();
    
    }else{
        $user_detail=new FranchiseDetail;
    }
    $user_detail->admin_id=$user->id;
    $user_detail->state_id=$request->state;
    $user_detail->district_id=$request->district;
    $user_detail->phone1=$request->phone1;
    $user_detail->phone2=$request->phone2;
    $user_detail->city=$request->city;
    $user_detail->address=$request->address;
    $user_detail->citizenship_no=$request->citizenship_no;
    $user_detail->custom_filed_1=$request->dob[0];
    $user_detail->custom_filed_2=$request->citizen_issue_place;
    $user_detail->custom_filed_3=$request->citizen_issue_date[0];
    $user_detail->save();
    

    DB::commit();
}


}