<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ConsumeUnit;
use Yajra\DataTables\Facades\DataTables;

class PaymentController extends Controller
{


 
       public function account(Request $request){
         
        if($request->ajax()){
       
              $units=Account::with('user')->where('user_id',Auth::user()->id)->orderBy('id','desc')->get();
       
          return DataTables::of($units)
        
          ->addColumn('customer',function($row){
              return  $row->user->meter_id;
          })

          ->addColumn('month',function($row){
              $html= __getNepaliDate($row->created_at,1);
            
              return $html;
          })

          ->addColumn('total',function($row){
              $html= $row->fine+$row->price;
            
              return $html;
          })


          ->rawColumns(['customer','month','action','status'])
          ->make(true);

      }
return view('frontend.auth.payment');
       }



public function Consumeunit(Request $request)
    {
        if($request->ajax()){
          $units=ConsumeUnit::with('user')->where('user_id',Auth::user()->id)->orderBy('id','desc')->get();
        
            return Datatables::of($units)
          
            ->addColumn('customer',function($row){
                return $row->user->meter_id;
            })
->addColumn('fine',function($row){
return __fine($row->created_at,today(),$row->price);

})

->addColumn('due',function($row){
     $data=__dueDate($row->created_at,today()).'<br>';
        $data.= __getNepaliDate($row->created_at,1);
        return $data;
    
    })

 
            ->addColumn('month',function($row){
                $html= __getNepaliDate($row->from);
                $html.='<br> -';
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

       
            ->rawColumns(['customer','month','action','status','due'])
            ->make(true);

        }
return view('frontend.auth.reading');
    }


    public function makePayment(){
        return view('frontend.auth.pay');
    }
}
