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

                $units=Account::with('user')->where('user_id',$id)->orderBy('id','desc')->get();
            }else{
                $units=Account::with('user')->orderBy('id','desc')->get();
                
            }

        }
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

        // try {
            DB::beginTransaction();
           $account=new Account;
           $account->amount=$request->amount;
           $account->fine=$request->fine;
           $account->user_id=$request->user;
           $account->remarks=$request->remark;
           $account->save();
           ConsumeUnit::where('user_id',$request->user)->where('status',0)->update(['status'=>1]);
           DB::commit();

            $notification=[
                'alert-type'=>'success',
                 'messege'=>'Created successfully'
            ];
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

    
}
