<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{


 

 public function index(){
      return view('frontend.contact');
 }

public function store(Request $request){

      $request->validate([
        'email'=>'required|email',
        'phone'=>'required',
        'name'=>'required',
        'message'=>'required',
      ]);
         try {
          //code...
         
      $contact=new Contact;
      $contact->name=$request->name;
      $contact->phone=$request->name;
      $contact->email=$request->name;
      $contact->message=$request->name;
      $contact->status=0;
       $contact->save();
        $notification=[
            'alert-type'=>'success',
             'messege'=>'Thank you for your query,We will get back to you as soon as possible.'
        ];
      } catch (\Throwable $th) {
        $notification=[
          'alert-type'=>'error',
           'messege'=>'Failed to place query.Try again later'
      ];
       }
        return redirect()->back()->with($notification);

    }

}
