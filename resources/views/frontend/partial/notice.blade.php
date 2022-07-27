<section class="categories-wrap" >
    <div class="container" style="box-shadow: none">
        <div class="cat-heading">
            <h2 class="custom-bg-primary custom-text-white custom-fs-20">
                Notice: <span>सूचना</span></h2>
        </div>
        @php
            $blogs=DB::table('blogs')->where('type',1)->orderBy('id','desc')->limit(8)->get();
        @endphp
        <div class="categories">
            @foreach ($blogs as $blog)
            <div class="cat-article shadow-sm thumbnail">
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

</section>