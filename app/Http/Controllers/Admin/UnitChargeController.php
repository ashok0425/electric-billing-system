<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\State;
use App\Models\UnitCharge;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
class UnitChargeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $units=UnitCharge::orderBy('id','desc')->get();
            return Datatables::of($units)
            ->addColumn('action',function($row){
                $html='
              <div class="d-flex justify-content-center">
              <a href="'.route('admin.unit_charges.edit',$row->id).'" class="btn btn-primary"><i class="fa fa-edit"></i></a>
              <a href="'.route('admin.unit_charges.delete',$row->id).'"  class="delete-btn btn btn-danger">
            <i class="fa fa-trash"></i>
              </a>
              </div>';
                return $html;
            }
            )->make(true);

        }
return view('admin.primary_setup.unit_charge.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.primary_setup.unit_charge.create');

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
            'from'=>'required',
            'to'=>'required',
            'price'=>'required',

        ]);
        try {
            $unit=new UnitCharge;
            $unit->from=$request->from;
            $unit->to=$request->to;
            $unit->price=$request->price;
            $unit->save();
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
     * @param  \App\Models\UnitCharge $District
     * @return \Illuminate\Http\Response
     */
    public function show(UnitCharge $unitCharge)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UnitCharge $District
     * @return \Illuminate\Http\Response
     */
    public function edit(UnitCharge $unitCharge)
    {
        $unit=UnitCharge::find($unitCharge->id);
        return view('admin.primary_setup.unit_charge.edit',compact('unit'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UnitCharge $District
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UnitCharge $unitCharge)
    {
        $request->validate([
            'from'=>'required',
            'to'=>'required',
            'price'=>'required',

        ]);
        try {
            $unit=UnitCharge::find($unitCharge->id);
            $unit->from=$request->from;
            $unit->to=$request->to;
            $unit->price=$request->price;
            $unit->save();
            $notification=[
                'alert-type'=>'success',
                 'messege'=>'Updated successfully'
            ];
        } catch (\Throwable $th) {
            $notification=[
                'alert-type'=>'error',
                 'messege'=>'Something went wrong.Please try again later'
            ];
        }
        return redirect()->route('admin.unit_charges.index')->with($notification);
   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UnitCharge $District
     * @return \Illuminate\Http\Response
     */
    public function destroy(UnitCharge $unitCharge,$id)
    {
        try {
            $Districts=UnitCharge::where('id',$id)->first();
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
