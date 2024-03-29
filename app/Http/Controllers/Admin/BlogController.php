<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Str;
use Yajra\DataTables\Facades\DataTables;
use File;
class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        if($request->ajax()){
     
                $blogs=Blog::orderBy('id','desc')->get();

            return DataTables::of($blogs)
          
            ->addColumn('action',function($row){
                $html='
              <div class="d-flex justify-content-center">
              <a href="'.route('admin.blogs.edit',$row->id).'" class="btn btn-primary"><i class="fa fa-edit"></i></a>
              <a href="'.route('admin.blogs.delete',$row->id).'"  class="delete-btn btn btn-danger">
            <i class="fa fa-trash"></i>
              </a>
              </div>';
                return $html;
            })

            ->editColumn('created_at',function($row){
                $html= __getNepaliDate($row->created_at,1);
              
                return $html;
            })

            ->editColumn('type',function($row){
                if ($row->type==1) {
                    $html='Notice';
                }
                if ($row->type==2) {
                    $html='Banner';
                }

                if ($row->type==3) {
                    $html='Team';
                }
              
                return $html;
            })

            ->rawColumns(['action'])
            ->make(true);

        }
return view('admin.blog.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
            return view('admin.blog.create');

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
            'title'=>'required',
             ]);

        try {
           $blog=new Blog;
           $blog->title=$request->title;
           $blog->description=$request->description;
           $blog->slug=Str::slug($request->title);
           $blog->type=$request->type;
           $blog->position=$request->position;

           $file=$request->file('thumbnail');
           
           if($file){
               $fname=rand().'blog.'.$file->getClientOriginalExtension();
               $blog->thumbnail='upload/blog/'.$fname;
               $file->move(public_path().'/upload/blog/',$fname);
           }
           $blog->save();
     

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
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        return view('admin.blog.edit',compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title'=>'required',
             ]);

        // try {
           $blog=Blog::find($blog->id);
           $blog->title=$request->title;
           $blog->description=$request->description;
           $blog->slug=Str::slug($request->title);
           $blog->type=$request->type;
           $blog->position=$request->position;
           $file=$request->file('thumbnail');
           if($file){
               File::delete($blog->thumbnail);
               $fname=rand().'blog.'.$file->getClientOriginalExtension();
               $blog->thumbnail='upload/blog/'.$fname;
               $file->move(public_path().'/upload/blog/',$fname);
           }
           $blog->save();
     

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
        return redirect()->back()->with($notification);
   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog,$id)
    {
        try {
            $blog=Blog::where('id',$id)->first();
            $blog->delete();
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
