@extends('frontend.layout.master')
@push('css')
    <style>
       @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap");*{margin:0;padding:0;-webkit-box-sizing:border-box;box-sizing:border-box;line-height:1.5;font-family:"poppins"}.section--title .title h1{font-size:24px;font-weight:500;}.section--title .description *{font-size:16px;}.section--title.center{-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center;text-align:center}.contact--item{display:-ms-grid;display:grid;grid-auto-rows:-webkit-min-content;grid-auto-rows:min-content;grid-gap:10px}.contact--itembox{display:-ms-grid;display:grid;grid-auto-rows:-webkit-min-content;grid-auto-rows:min-content;grid-gap:20px}.contact--itemtitle .title *{font-size:19px;font-weight:600;}.contact--itemdes ul{display:block;list-style:none}.contact--itemdes ul li{font-size:16px;}.contact--itemdes ul li a{text-decoration:none}.contact--itemdes ul li *{}.contact--form{display:-ms-grid;display:grid;grid-auto-rows:-webkit-min-content;grid-auto-rows:min-content;grid-gap:15px}.contact--formbox{padding:30px;border-radius:6px;background:#fff;position:relative;z-index:1}.contact--formbox>span{position:absolute;top:50%;-webkit-transform:translateY(-50%);transform:translateY(-50%);right:calc(100% + 30px);;display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-align:center;-ms-flex-align:center;align-items:center;-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center;-ms-flex-wrap:wrap;flex-wrap:wrap;-webkit-box-orient:vertical;-webkit-box-direction:normal;-ms-flex-direction:column;flex-direction:column}.contact--formbox>span::before,.contact--formbox>span::after{content:"";background:rgb(27, 27, 27);width:1px;height:150px;margin:0 0 10px 0}.contact--formbox>span::after{margin:10px 0 0 0}.contact--form .form--title{display:-ms-grid;display:grid;grid-auto-rows:-webkit-min-content;grid-auto-rows:min-content;place-items:center;text-align:center;grid-gap:5px}.contact--form .form--title .title *{font-size:19px;font-weight:500}.contact--form .form{display:-ms-grid;display:grid;grid-auto-rows:-webkit-min-content;grid-auto-rows:min-content;grid-gap:10px}.contact--form .form .form-group{width:100%}.contact--form .form .form-group .btn-holder{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center;-webkit-box-align:center;-ms-flex-align:center;align-items:center;margin-top:30px}.contact--form .form .form-group .btn-holder button{color:#fff;background:#133f64;border-radius:50px;padding:12px 40px;text-align:center;min-width:200px;;font-weight:500}.form-control{all:unset;padding:10px 15px;border-bottom:1px solid #ddd;display:block;width:-webkit-fill-available;width:-moz-available;width:stretch}
/*# sourceMappingURL=style.css.map */
    </style>
    
@endpush
@section('content')
<x-bread-crum title="Contact"/>

<section class="contact--section container shadow p-3 py-5 my-5 ">

    <div class="row ">
        <div class="section--box col-md-6">
            <div class="section--title px-4 pt-4">
                <div class="title">
                    <h1>Tell Us about your project</h1>
                </div>
                <div class="description">
                    <p>Hit us in any convenient way: give us a call, shoot us a email or fill the form below.</p>
                </div>
            </div>
            <div class="contact--box ">
                @php
                    $cms=DB::table('cms')->first();
                @endphp
                <div class="contact--itembox">
                        <div class="contact--item">
                            
                            <div class="contact--itemdes">
                                <ul>
                                    <li>Email Address</li>
                                    <li><a href="mailto:{{$cms->email1}}" class="text-dark">{{$cms->email1}}</a></li>
                                </ul>
                            </div>
                            <div class="contact--itemdes">
                                <ul>
                                    <li>Phone</li>
                                    <li><a href="tel:{{$cms->phone1}}" class="text-dark">{{$cms->phone1}}</a>
                                    </li>
                                </ul>
                            </div>


                            <div class="contact--itemdes">
                                <ul>
                                    <li>Address</li>
                                    <li><a href="#" class="text-dark">{{$cms->address1}}</a></li>
                                </ul>
                            </div>
                        </div>
                </div>
            </div>
        </div>

                <div class="contact--formbox col-md-6">
                    <span>OR</span>
                    <form  class="contact--form" action="{{route('contact')}}" method="POST">
                        @csrf
                        <div class="form--title">
                            <div class="title">
                                <h5>Write a Message</h5>
                            </div>
                            <div class="description">
                                <p>Write a query to us. We will get back to you as sson as possible.</p>
                            </div>
                        </div>
                        <div class="form">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Please Enter your name" required name="name">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Please Enter your Email" required name="email">
                            </div>
                            <div class="form-group">
                                <input type="number" class="form-control" placeholder="Please Enter Phone number" required name="phone">
                            </div>
                            <div class="form-group">
                                <textarea rows="1" class="form-control" placeholder="Your Message" required name="message"></textarea>
                            </div>
                            <div class="form-group">
                                <div class="btn-holder">
                                    <button type="submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
        </div>
    </div>
</section>
@endsection