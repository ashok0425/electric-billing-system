<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\ConsumeUnit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$id=null)
    {
        
        if($request->ajax()){
            if(Auth::guard('admin')->user()->type=='franchise'){
                if($id!=null){
                    $units=Account::whereHas('user',function($q){
                        $q->where('franchise_id','=',Auth::guard('admin')->user()->id);
                    })->orderBy('id','desc')->where('user_id',$id)->get();
                }else{
                $units=Account::whereHas('user',function($q){
                    $q->where('franchise_id','=',Auth::guard('admin')->user()->id);
                })->orderBy('id','desc')->get();
            }
            }else{
                if($id!=null){

                $units=Account::with('user')->where('user_id',$id)->orderBy('created_at','desc')->get();
            }else{
                $units=Account::with('user')->orderBy('created_at','desc')->get();
                
            }

        }
            return DataTables::of($units)
          
            ->addColumn('customer',function($row){
                return  $row->user->meter_id;
            })

            ->addColumn('action',function($row){
                $html=' <a href="'.route('admin.accounts.invoice',$row->id).'" class="btn btn-primary">print</a>';
                return $html;
            })
      
            ->addColumn('total',function($row){
                $html= $row->fine+$row->amount;
              
                return $html;
            })

            ->addColumn('month',function($row){
                $html= __getNepaliDate($row->created_at,1);
              
                return $html;
            })
            ->rawColumns(['customer','month','action','status'])
            ->make(true);

        }
return view('admin.payment.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id=null)
    {
        if (Auth::guard('admin')->user()->type=='admin')
        {
            $users=User::all();

        }else{
            $users=User::where('franchise_id',Auth::guard('admin')->user()->id)->get();
        }

        return view('admin.payment.create',compact('users','id'));

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
            'remark'=>'required',
            'amount'=>'required',
            'user'=>'required',


        ]);
        $units=ConsumeUnit::where('user_id',$request->user)->where('status',0)->get();
        $fine=0;
        $price=0;
        $cid=[];
           foreach($units as $value){
            $fine+=__fine($value->created_at,today(),$value->price);
            $price+=$value->price;
            $cid[]=$value->id;
           }

        // try {
            DB::beginTransaction();
           $account=new Account;
           $account->amount=$request->amount;
           $account->fine=$request->fine;
           $account->user_id=$request->user;
           $account->remarks=$request->remark;

           $recent_order=Account::orderBy('id','desc')->where('voucher_no','!=',null)->whereYear('created_at',date('Y'))->first();
           if ($recent_order) {
            $arr=explode('/',$recent_order->voucher_no);
               $bill_no=str_pad($arr[0] + 1, 6, "0", STR_PAD_LEFT);
           }else{
               $bill_no=str_pad(1, 6, "0", STR_PAD_LEFT);
           }
           $year=date('Y')+57;
           
           $account->voucher_no=$bill_no.'/'.$year;

           $account->save();
           session()->put('consume_id',$cid);
           ConsumeUnit::where('user_id',$request->user)->where('status',0)->update(['status'=>1]);
           DB::commit();

            $notification=[
                'alert-type'=>'success',
                 'messege'=>'Created successfully'
            ];
            $id=$request->user;
            $voucher_no=$account->voucher_no;
            if (count($cid)>0) {
                return view('invoice.invoice',compact('id','voucher_no'));

            }
        // } catch (\Throwable $th) {
        //     $notification=[
        //         'alert-type'=>'error',
        //          'messege'=>'Something went wrong.Please try again later'
        //     ];
        // }
        return redirect()->back()->with($notification);
   
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

    public function loadAmount(Request $request){
        $units=ConsumeUnit::where('user_id',$request->id)->where('status',0)->get();
        $fine=0;
        $price=0;
           foreach($units as $value){
            $fine+=__fine($value->created_at,today(),$value->price);
            $price+=$value->price;

           }

$data=[
    'fine'=>$fine,
    'price'=>$price,
];

return response($data);
    }


    public function print($id){

            return view('invoice.account_invoice',compact('id'));

    }
    
}
