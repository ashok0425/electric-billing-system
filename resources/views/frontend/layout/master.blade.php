@php
    $setting=DB::table('cms')->first();
@endphp
@section('title')
    {{ $setting->meta_title }}
@endsection
@section('descr')
    {{ $setting->meta_description }}
@endsection
@section('keyword')
    {{ $setting->keyword }}
@endsection
@section('title')
    {{ $setting->meta_title }}
@endsection
@section('img')
    {{ asset($setting->logo) }}
@endsection
@section('url')
    {{ Request::url() }}
@endsection
@section('fev')
    {{ asset($setting->fev) }}
@endsection



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <meta name="author" content="{{$seo->meta_author}}"> --}}
    <meta name="keyword" content="@yield('keyword')">
    <meta name="description" content="@yield('descr')">

    <link rel="shortcut  icon" href="@yield('fev')" type="image/icon type">

    <title>@yield('title')</title>

    <meta property="fb:app_id" content="160443599540603" />
    <meta property="og:url" content="@yield('url')" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="@yield('title')" />
    <meta property="og:description" content="@yield('descr')" />
    <meta property="og:image" content="@yield('img')" />
    <meta property="og:image:secure_url" content="@yield('img')" />

    <!-- IMPORTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mukta:wght@200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    {{-- toastr --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    @stack('css')
    <style>
        .breadcrumb {
            padding: 35px 0;
            background: -webkit-gradient(linear, left top, right top, from(#133f64), to(#17d0dd));
            background: linear-gradient(90deg, #133f64 0%, #377be0 100%);
        }

        .footer .top-footer .footer-items .footer-links {
            margin-top: 10px;
        }

        .logo {
            width: 190px;
        }
        .banner{
            position: relative;
        }
      
        .owl-carousel .owl-nav button.owl-next{
            left: 93%!important;
            position: absolute;
            top: 50%

        }

        .owl-carousel .owl-nav button.owl-prev{
            left: .5%!important;
            position: absolute;
            top: 50%

        }
        .owl-carousel .owl-nav button.owl-next, .owl-carousel .owl-nav button.owl-prev, .owl-carousel button.owl-dot{
          font-size: 30px;
          color: #fff;
          background: rgba(255, 251, 250, .5);
          height: 40px;
          width: 40px;
          border-radius: 50%;

        }
    </style>
</head>

<body class="custom-bg-white custom-font-mukta">

    @include('frontend.layout.header')

    @yield('content')


    @include('frontend.layout.footer')

    <!-- JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="{{ asset('frontend/js/app.js') }}"></script>
    {{-- toastr --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    @stack('scripts')
    <script>
        @if (Session::has('messege')) //toatser
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':
                    toastr.info("{{ Session::get('messege') }}");
                    break;
                case 'success':
                    toastr.success("{{ Session::get('messege') }}");
                    break;
                case 'warning':
                    toastr.warning("{{ Session::get('messege') }}");
                    break;
                case 'error':
                    toastr.error("{{ Session::get('messege') }}");
                    break;
            }
        @endif



        $('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    responsiveClass:true,
    nav:true,
   loop:true,
navText:['⬅','➡'],
    responsive:{
        0:{
            items:1,
        },
        600:{
            items:3,
        },
        1000:{
            items:1,
          
        }
    }
})
    </script>







</body>

</html>
