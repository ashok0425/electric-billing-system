@extends('frontend.layout.master')
@section('content')
<x-bread-crum title="About"/>

<div class="container my-5">
   <div class="row">
    <div class="col-md-10 offset-md-1">
        <div class="card shadow">
            <div class="card-body">
                <h3 class="text-center">
                    हाम्रो बारे
                </h3>
                <br>
{{$about->about}}
               
            </div>
        </div>
    </div>

   </div>
   
    
</div>

@endsection