@extends('frontend.layout.master')
@push('css')
    <style>
         @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap")  
    *{margin:0;padding:0;-webkit-box-sizing:border-box;box-sizing:border-box;line-height:1.5;font-family:"poppins"}.section--title .title h1{font-size:42px;font-weight:500;color:#fff}.section--title .description *{font-size:18px;color:rgba(255,255,255,0.9)}.section--title.center{-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center;text-align:center}.contact--item{display:-ms-grid;display:grid;grid-auto-rows:-webkit-min-content;grid-auto-rows:min-content;grid-gap:10px}.contact--itembox{display:-ms-grid;display:grid;grid-auto-rows:-webkit-min-content;grid-auto-rows:min-content;grid-gap:20px}.contact--itemtitle .title *{font-size:24px;font-weight:600;color:rgba(255,255,255,0.9)}.contact--itemdes ul{display:block;list-style:none}.contact--itemdes ul li{font-size:16px;color:rgba(255,255,255,0.8)}.contact--itemdes ul li a{text-decoration:none}.contact--itemdes ul li *{color:rgba(255,255,255,0.9)}.contact--formbox{padding:30px;border-radius:6px;z-index:1}.contact--formbox>span{position:absolute;top:50%;-webkit-transform:translateY(-50%);transform:translateY(-50%);right:calc(100% + 30px);color:#fff;display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-align:center;-ms-flex-align:center;align-items:center;-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center;-ms-flex-wrap:wrap;flex-wrap:wrap;-webkit-box-orient:vertical;-webkit-box-direction:normal;-ms-flex-direction:column;flex-direction:column}.contact--formbox>span::before,.contact--formbox>span::after{content:"";background:#fff;width:1px;height:150px;margin:0 0 10px 0}.contact--formbox>span::after{margin:10px 0 0 0}.contact--form .form--title .title *{font-size:24px;font-weight:500}.contact--form .form{display:-ms-grid;display:grid;grid-auto-rows:-webkit-min-content;grid-auto-rows:min-content;grid-gap:10px}.contact--form .form .form-group{width:100%}.contact--form .form .form-group .btn-holder{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center;-webkit-box-align:center;-ms-flex-align:center;align-items:center;margin-top:30px}.contact--form .form .form-group .btn-holder button{all:unset;1794b2;border-radius:50px;padding:12px 40px;text-align:center;min-width:200px;color:#fff;font-weight:500}.form-control{all:unset;padding:10px 15px;border-bottom:1px solid #ddd;display:block;width:-webkit-fill-available;width:-moz-available;width:stretch}
/*# sourceMappingURL=style.css.map */
    </style>
    
@endpush
@section('content')
<br>
  <br>
<div class="container">
<section class="contact--section shadow">
  

        <div class="section--box">
            
            <div class="contact--box row">
            
                <div class="contact--itembox col-md-6 d-none d-md-block">
                  @php
                      $cms=DB::table('cms')->first();
                  @endphp
                   <img src="{{asset($cms->login_image)}}" alt="{{$cms->company_name}}" class="img-fluid" width="70%" style="height: 90%">
                </div>
                <div class="contact--formbox col-md-6">
                
                    <form action="{{route('login')}}" class="contact--form" method="POST">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                      @csrf
                      <div class="form--title">
                        <div class="title">
                          <h5>Login to your Account</h5>
                        </div>

                          <div class="description">

                          </div>
                      
                    </div>
                        <div class="form">

                            <div class="form-group mt-3">
                                <input type="text" class="form-control" placeholder=" Email Address" name="email">
                            </div>
                            <br>

                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Password" name="password">
                            </div>
                           
                            <div class="form-group">
                                <div class="btn-holder">
                                    <button type="submit" style="background: #133f64">Login</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</section>
</div>
@endsection