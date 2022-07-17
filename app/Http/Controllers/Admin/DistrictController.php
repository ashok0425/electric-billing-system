<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\District;
use App\Models\State;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $district=District::orderBy('id','desc')->get();
            return Datatables::of($district)
            ->addColumn('action',function($row){
                $html='
              <div class="d-flex justify-content-center">
              <a href="'.route('admin.districts.edit',$row->id).'" class="btn btn-primary"><i class="fa fa-edit"></i></a>
              <a href="'.route('admin.districts.delete',$row->id).'"  class="delete-btn btn btn-danger">
            <i class="fa fa-trash"></i>
              </a>
              </div>';
                return $html;
            }
            )->make(true);

        }
return view('admin.primary_setup.district.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states=State::all();
        return view('admin.primary_setup.district.create',compact('states'));

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
            'district'=>'required',
            'state'=>'required',

        ]);
        try {
            $District=new District;
            $District->name=$request->district;
            $District->state_id=$request->state;

            $District->save();
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
     * @param  \App\Models\District  $District
     * @return \Illuminate\Http\Response
     */
    public function show(District $District)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\District  $District
     * @return \Illuminate\Http\Response
     */
    public function edit(District $district)
    {
        $district=District::find($district->id);
        $states=State::all();

        return view('admin.primary_setup.district.edit',compact('district','states'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\District  $District
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, District $district)
    {

        $request->validate([
            'district'=>'required'
        ]);
        // try {
            $district=District::find($district->id);
            $district->name=$request->district;
            $district->save();
            $notification=[
                'alert-type'=>'success',
                 'messege'=>'Updated successfully'
            ];
        // } catch (\Throwable $th) {
        //     $notification=[
        //         'alert-type'=>'error',
        //          'messege'=>'Something went wrong.Please try again later'
        //     ];
        // }
        return redirect()->route('admin.districts.index')->with($notification);
   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\District  $District
     * @return \Illuminate\Http\Response
     */
    public function destroy(District $district,$id)
    {
        try {
            $Districts=District::where('id',$id)->first();
            $Districts->delete();
            $notification=[
                'alert-type'=>'success',
                 'messege'=>'Delete successfully'
            ];
        } catch (\Throwable $th) {
            $notification=[
                'alert-type'=>'error',
                 'messege'=>'Something went wrong.Please try again later'
            ];
        }
        return redirect()->back()->with($notification);
   

    }
}
