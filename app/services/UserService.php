<?php
namespace App\services;

use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserService {



public function CreateOrUpdate(Request $request,$id=null){

 
DB::beginTransaction();
if($id!=null){
    $user=User::find($id);

}else{
    $user=new User;
    $user->password=$request->password;
    $user->costumer_id=$request->costumer_id;
    $user->meter_id=$request->meter_id;
   
}
$user->name=$request->name;
$user->email=$request->email;
$user->status=$request->status;
if (Auth::guard('admin')->user()->type=='admin') {
    $user->franchise_id=$request->franchise_id;

}else{
    $user->franchise_id=Auth::guard('admin')->user()->id;

}
$user->save();

    if($id!=null){
        $user_detail=UserDetail::where('user_id',$id)->first();
    
    }else{
        $user_detail=new UserDetail;
    }
    $user_detail->user_id=$user->id;
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