<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      
        if($request->ajax()){
            $users=Contact::orderBy('id','desc')->get();
            return DataTables::of($users)
            ->editColumn('created_at','{{__getNepaliDate($created_at,1)}}')
//             ->editColumn('status',function($row){
//                 if ($row->status==0) {
//                     return '<div class="badge bg-danger text-white">pending</div>';
//                 }elseif($row->status==1){
//                     return '<div class="badge bg-success text-white">Active</div>';

//                 }
//                 else{
//                     return '<div class="badge bg-primary text-white">Blocked</div>';

//                 }
//             })

//             ->addColumn('action',function($row){
//                 $html='
//               <div class="d-flex justify-content-center">
//               <a href="'.route('admin.user_details.edit',$row->id).'" class="btn btn-primary"><i class="fa fa-edit"></i></a>
//               <a href="'.route('admin.user_details.show',$row->id).'"  class=" btn btn-primary">
//             <i class="fa fa-eye"></i>

//               </a>

//               <a href="'.route('admin.user_details.pay',$row->id).'"  class=" btn btn-primary">
//               <i class="fa fa-money-bill"></i>
// </a>
//               </div>';
//                 return $html;
//             }
            // )
            // ->rawColumns(['status','action'])
            ->make(true);

        }
        return view('admin.contact.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        //
    }
}
