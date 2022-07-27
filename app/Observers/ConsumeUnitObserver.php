<?php

namespace App\Observers;

use App\Models\ConsumeUnit;
use App\Models\UnitCharge;

class ConsumeUnitObserver
{
    /**
     * Handle the ConsumeUnit "created" event.
     *
     * @param  \App\Models\ConsumeUnit  $consumeUnit
     * @return void
     */


    public function creating($request)
    {

        $price=0;
      
        $base_price=UnitCharge::where('from',0)->where('to',15)->value('price');
        $base_price=$base_price*15;
        $unit_price_15_to_25=UnitCharge::where('from',15)->where('to',25)->value('price');
        $unit_price_25_to_infinty=UnitCharge::where('from',25)->where('to',1000000)->value('price');
    $unit=$request->current_total_unit-$request->last_meter_reading;
        $request['unit']=$unit;

       if($request->unit>15 && $request->unit<=25 ){
        // subracting unitfrom existig unit 
                $remain_unit=$request->unit-15;
                $price_for_remain_unit=$remain_unit*$unit_price_15_to_25;
                $price=$base_price+$price_for_remain_unit;
    
            }

            elseif($request->unit>25){

                $price_for_remain_unit_15_to_25=10*$unit_price_15_to_25;

                $remain_unit=$request->unit-25;
                $price_for_remain_unit_25_to_infinity=$remain_unit*$unit_price_25_to_infinty;



                $price=$base_price+$price_for_remain_unit_15_to_25+$price_for_remain_unit_25_to_infinity;
        
                }
        
        else{
                    $price=$base_price;
        }
       

        // $fine=
        $request['price'] =round( $price);
        // $request['fine']=;

    }


    public function updating($request)
    {

        $price=0;
      
        $base_price=UnitCharge::where('from',0)->where('to',15)->value('price');
        $base_price=$base_price*15;
        $unit_price_15_to_25=UnitCharge::where('from',15)->where('to',25)->value('price');
        $unit_price_25_to_infinty=UnitCharge::where('from',25)->where('to',1000000)->value('price');
    $unit=$request->current_total_unit-$request->last_meter_reading;
        $request['unit']=$unit;

       if($request->unit>15 && $request->unit<=25 ){
        // subracting unitfrom existig unit 
                $remain_unit=$request->unit-15;
                $price_for_remain_unit=$remain_unit*$unit_price_15_to_25;
                $price=$base_price+$price_for_remain_unit;
    
            }

            elseif($request->unit>25){

                $price_for_remain_unit_15_to_25=10*$unit_price_15_to_25;

                $remain_unit=$request->unit-25;
                $price_for_remain_unit_25_to_infinity=$remain_unit*$unit_price_25_to_infinty;



                $price=$base_price+$price_for_remain_unit_15_to_25+$price_for_remain_unit_25_to_infinity;
        
                }
        
        else{
                    $price=$base_price;
        }
       

        // $fine=
        $request['price'] =round( $price);
        // $request['fine']=;

    }










    public function created(ConsumeUnit $consumeUnit)
    {
        //
    }

    /**
     * Handle the ConsumeUnit "updated" event.
     *
     * @param  \App\Models\ConsumeUnit  $consumeUnit
     * @return void
     */
    public function updated(ConsumeUnit $consumeUnit)
    {
        //
    }

    /**
     * Handle the ConsumeUnit "deleted" event.
     *
     * @param  \App\Models\ConsumeUnit  $consumeUnit
     * @return void
     */
    public function deleted(ConsumeUnit $consumeUnit)
    {
        //
    }

    /**
     * Handle the ConsumeUnit "restored" event.
     *
     * @param  \App\Models\ConsumeUnit  $consumeUnit
     * @return void
     */
    public function restored(ConsumeUnit $consumeUnit)
    {
        //
    }

    /**
     * Handle the ConsumeUnit "force deleted" event.
     *
     * @param  \App\Models\ConsumeUnit  $consumeUnit
     * @return void
     */
    public function forceDeleted(ConsumeUnit $consumeUnit)
    {
        //
    }
}
