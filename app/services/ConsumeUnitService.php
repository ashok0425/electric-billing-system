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
    $recent_order=ConsumeUnit::orderBy('id','desc')->whereYear('created_at',date('Y'))->first();
    if ($recent_order) {
     $arr=explode('/',$recent_order->bill_no);
        $bill_no=str_pad($arr[0] + 1, 6, "0", STR_PAD_LEFT);
    }else{
        $bill_no=str_pad(1, 6, "0", STR_PAD_LEFT);
    }
    $year=date('Y')+57;
    
    $consume_unit->bill_no=$bill_no.'/'.$year;



}
$consume_unit->user_id=$request->user;
$consume_unit->from=$request->from[0];
$consume_unit->to=$request->to[0];
$consume_unit->unit=$request->unit;
$consume_unit->price=$request->price;
$consume_unit->current_total_unit=$request->current_total_unit;
$consume_unit->last_meter_reading=$request->last_meter_reading;
$consume_unit->status=$request->status?$request->status:0;

if ($request->meter_reading_date!=null) {
$consume_unit->created_at=$request->meter_reading_date;
    
}
$consume_unit->save();
    DB::commit();

}


}