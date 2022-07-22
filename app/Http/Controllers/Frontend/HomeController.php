<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use App\Models\Contact;

class HomeController extends Controller
{


 

 public function blog(){
     $blogs=Blog::orderBy('id','desc')->paginate(12);
      return view('frontend.blog.index',compact('blogs'));
 }


 
 public function blogDetail($id){
     $blog=Blog::find($id);
     $blogs=Blog::inrandomOrder()->limit(6)->get();

  return view('frontend.blog.show',compact('blog','blogs'));
}

}
