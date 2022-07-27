<?php
namespace App\services;

use App\Models\ConsumeUnit;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConsumeUnitService {



public function CreateOrUpdate(Request $request,$id=null){
DB::beginTransaction();
if($id!=null){
    $consume_unit=ConsumeUnit::find($id);

}else{
    $consume_unit=new ConsumeUnit;
    // $consume_unit->bill_no=;


}
$consume_unit->user_id=$request->user;
$consume_unit->from=$request->from[0];
$consume_unit->to=$request->to[0];
$consume_unit->unit=$request->unit;
$consume_unit->price=$request->price;
$consume_unit->current_total_unit=$request->current_total_unit;
$consume_unit->last_meter_reading=$request->last_meter_reading;

$consume_unit->status=$request->status?$request->status:0;
$consume_unit->save();


    DB::commit();

}


}