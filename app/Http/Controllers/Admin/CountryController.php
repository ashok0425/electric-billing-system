<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $country=Country::orderBy('id','desc')->get();
            return Datatables::of($country)
            ->addColumn('action',function($row){
                $html='
              <div class="d-flex justify-content-center">
              <a href="'.route('admin.countries.edit',$row->id).'" class="btn btn-primary"><i class="fa fa-edit"></i></a>
              <a href="'.route('admin.countries.delete',$row->id).'"  class="delete-btn btn btn-danger">
            <i class="fa fa-trash"></i>
              </a>
              </div>';
                return $html;
            }
            )->make(true);

        }
return view('admin.primary_setup.country.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.primary_setup.country.create');

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
            'country'=>'required'
        ]);
        try {
            $country=new Country;
            $country->name=$request->country;
            $country->save();
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
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        $country=Country::find($country);
        return view('admin.primary_setup.country.edit',compact('country'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Country $country)
    {
        $request->validate([
            'country'=>'required'
        ]);
        try {
            $country=Country::find($country->id);
            $country->name=$request->country;
            $country->save();
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
        return redirect()->route('admin.countries.index')->with($notification);
   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country,$id)
    {
        try {
            $countrys=Country::where('id',$id)->first();
            $countrys->delete();
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
