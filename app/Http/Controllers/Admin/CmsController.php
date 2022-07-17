<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Cms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use File;
class CmsController extends Controller
{
    
    public function edit()
    {
        $cms=Cms::find(1);

        return view('admin.cms.index',compact('cms'));

    }

   
    public function update(Request $request)
    {
     
        // try {
            $web=Cms::find(1);
            $web->meta_title=$request->title;
            $web->keyword=$request->keyword;
            $web->meta_description=$request->descr;
            $web->email1=$request->email1;
            $web->email2=$request->email2;
            $web->phone1=$request->phone1;
            $web->phone2=$request->phone2;
            $web->address1=$request->address1;
            $web->address2=$request->address2;
            $web->facebook=$request->facebook;
            $web->twitter=$request->twitter;
            $web->instagram=$request->instagram;
            $web->youtube=$request->youtube;
            $web->tiktok=$request->tiktok;
            $web->pinterest=$request->pinterest;
            $web->linkedin=$request->linkdin;
            $web->copy_right=$request->copy_right;
            $web->company_register_no=$request->c_no;
            $web->about=$request->about;
            $web->term=$request->term;
            $web->policy=$request->policy;



            $file=$request->file('file');

            if($file){
                File::delete(public_path($web->logo));
                $fname=rand().'seeting.'.$file->getClientOriginalExtension();
                $web->logo='upload/setting/logo/'.$fname;
                $file->move(public_path().'/upload/setting/logo/',$fname);
                    }

                    $fev=$request->file('fev');
            if($fev){
                File::delete(public_path($web->fev));
                $fname=rand().'fev.'.$fev->getClientOriginalExtension();
                $web->fev='upload/setting/fev/'.$fname;
                $fev->move(public_path().'/upload/setting/fev/',$fname);
                    }
            $web->save();
            $notification=[
                'alert-type'=>'success',
                 'messege'=>'Updated successfully'
            ];
        // } catch (\Throwable $th) {
        //     DB::rollback();
        //     $notification=[
        //         'alert-type'=>'error',
        //          'messege'=>'Something went wrong.Please try again later'
        //     ];
        // }
        return redirect()->back()->with($notification);
   
    }

   
}
