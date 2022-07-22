@extends('frontend.layout.master')
@section('content')
<x-bread-crum title="Notice"/>

<section class="categories-wrap">
    <div class="container">
        
        <div class="categories">
            @foreach ($blogs as $blog)
            <div class="cat-article">
                <a href="{{route('blog.detail',['id'=>$blog->id])}}">

                    <div class="img-wrap">
                        <img src="{{asset($blog->thumbnail)}}" alt="" class="img-fluid">
                    </div>
                    <div class="article-title">
                        <h2 class="custom-fw-600 custom-fs-18">

                              {{$blog->title}}
                        </h2>
                    </div>
                </a>
                
            </div>
            @endforeach
  

            

    </div>
<br>
<br>

   <div class="text-center d-flex justify-content-center">
    {{$blogs->links()}}
   </div>

</section>
@endsection