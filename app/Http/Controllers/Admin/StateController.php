<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $state=State::orderBy('id','desc')->get();
            return Datatables::of($state)
            ->addColumn('action',function($row){
                $html='
              <div class="d-flex justify-content-center">
              <a href="'.route('admin.states.edit',$row->id).'" class="btn btn-primary"><i class="fa fa-edit"></i></a>
              <a href="'.route('admin.states.delete',$row->id).'"  class="delete-btn btn btn-danger">
            <i class="fa fa-trash"></i>
              </a>
              </div>';
                return $html;
            }
            )->make(true);

        }
return view('admin.primary_setup.state.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries=Country::all();
        return view('admin.primary_setup.state.create',compact('countries'));

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
            'state'=>'required',
            'country'=>'required',

        ]);
        try {
            $State=new State;
            $State->name=$request->state;
            $State->country_id=$request->country;

            $State->save();
            $notification=[
                'alert-type'=>'success',
                 'messege'=>'Created successfully'
            ];
        } catch (\Throwable $th) {
            $notification=[
                'alert-type'=>'error',
                 'messege'=>'Something went wrong.Please try again later'
            ];
        }
        return redirect()->back()->with($notification);
   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\State  $State
     * @return \Illuminate\Http\Response
     */
    public function show(State $State)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\State  $State
     * @return \Illuminate\Http\Response
     */
    public function edit(State $State)
    {
        $state=State::find($State->id);
        $countries=Country::all();

        return view('admin.primary_setup.state.edit',compact('state','countries'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\State  $State
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, State $state)
    {
        $request->validate([
            'state'=>'required'
        ]);
        try {
            $State=State::find($state->id);
            $State->name=$request->state;
            $State->save();
            $notification=[
                'alert-type'=>'success',
                 'messege'=>'Updated successfully'
            ];
        } catch (\Throwable $th) {
            DB::rollback();
            $notification=[
                'alert-type'=>'error',
                 'messege'=>'Something went wrong.Please try again later'
            ];
        }
        return redirect()->route('admin.states.index')->with($notification);
   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\State  $State
     * @return \Illuminate\Http\Response
     */
    public function destroy(State $state,$id)
    {
        try {
            $States=State::where('id',$id)->first();
            $States->delete();
            $notification=[
                'alert-type'=>'success',
                 'messege'=>'Delete successfully'
            ];
        } catch (\Throwable $th) {
            DB::rollback();

            $notification=[
                'alert-type'=>'error',
                 'messege'=>'Something went wrong.Please try again later'
            ];
        }
        return redirect()->back()->with($notification);
   

    }
}
