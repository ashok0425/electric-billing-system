<div class="container my-5">
    <div class="row">
        @php
            $banners=DB::table('blogs')->where('type',2)->orderBy('id','desc')->limit(8)->get();
            $teams=DB::table('blogs')->where('type',3)->orderBy('id','desc')->limit(8)->get();

        @endphp
        <div class="col-lg-9">
            <div class="owl-carousel banner-carousel">
           
            @foreach ($banners as $post)
               <div class="item banner-image">
                <img class="img-fluid " src="{{asset($post->thumbnail)}}" style="object-fit: cover;max-height: 450px!important">
    
                <span class="banner-text text-light px-2">
                    <h2>
                        {{$post->title}}</h2> 
                </span>
               </div>
            @endforeach
            </div>
        </div>
        <div class="col-md-3">
            <div class="team-wrapper text-center">
                @foreach ($teams as $item)
                <div class="team mb-2">
                    <img src="{{asset($item->thumbnail)}}" alt="" class="img-fluid thumbnail shadow-sm">
                    <div class="team-text">
                        {{$item->title}}
                        <br>
                        {{$item->position}}

                    </div>
                </div>
                @endforeach
             
            </div>
        </div>
    </div>
</div>