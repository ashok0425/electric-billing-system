@extends('frontend.layout.master')
@section('content')
<x-bread-crum title="Notice"/>

<div class="container my-5">
   <div class="row">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h3>
                    {{$blog->title}}
                </h3>

                <div class="images thumbnail border">
                    <img src="{{asset($blog->thumbnail)}}" alt="" class="img-fluid">
                </div>

                <p>
                    <br>
                    {!!$blog->description!!}
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h3>
                    अन्य सूचना
                </h3>
                @foreach ($blogs as $item)
                <p class="border-bottom py-1">
                 {{$loop->iteration}}) &nbsp;   {{$item->title}}

                </p>
                @endforeach
                
            </div>
        </div>
    </div>
   </div>
   
    
</div>

@endsection