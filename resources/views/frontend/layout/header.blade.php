    <!-- Logo and more ad -->
    @php
        $cms=DB::table('cms')->first();
    @endphp
    <section class="container">
        <div class="d-flex justify-content-between align-items-center">
            <div
                class="custom-ad-banner-700  d-none d-md-block d-flex">
                <div class="pt-3">
                    <iframe scrolling="no" border="0" frameborder="0" marginwidth="0" marginheight="0" allowtransparency="true" src="https://www.ashesh.com.np/linknepali-time.php?time_only=no&font_color=333333&aj_time=yes&font_size=14&line_brake=0&bikram_sambat=0&nst=no&api=152076m378" width="307" height="22"></iframe>
             <div class="d-flex">
                <a href="mailto:{{$cms->email1}}" target="_blank" rel="noopener noreferrer" class="text-dark mx-1"><i class="fas fa-envelope"></i> {{$cms->email1}}</a>
                <a href="mailto:{{$cms->phone1}}" target="_blank" rel="noopener noreferrer" class="text-dark mx-1"><i class="fas fa-phone-alt"></i> {{$cms->phone1}}</a>

             </div>
                </div>
              
            </div>
            <div class="logo ">
                <a href="{{route('/')}}">
                    <div class="logo-img">
                        <img src="{{asset($cms->logo)}}" alt="Logo Main" class="img-fluid " >
                    </div>
                </a>
              
            </div>
            
        </div>
    </section>

    <!-- Navigation Bar-->
    <nav class="navbar navbar-expand-lg custom-bg-primary custom-fs-18 p-0 sticky-top">
        <div class="container">
            <div class="bar custom-text-white" id='bar'><i class="fas fa-bars"></i></div>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{route('/')}}">होमपेज</a>
                    </li>
                   
                   
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('about')}}"> हाम्रो बारे</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('blogs')}}">सूचना</a>
                    </li>
                 
                     <li class="nav-item">
                        <a class="nav-link" href="{{route('contact')}}">सम्पर्क</a>
                    </li>
                </ul>
            </div>
            <div class="d-flex custom-text-white ">
             
                
               
                <div class="language custom-bg-dark-primary custom-transtion">
               <a href="{{route('login')}}" class="text-light">
                Login
               </a>
               
                </div>
            </div>
        </div>
       
            <div class="slide-nav" id="slide-menu">
                <div class="slide-menu" id="menu">
                    <ul class="menu">
                            <a  href="{{route('/')}}">
                                
                                <li>  होमपेज</li>
                    </a>
                       
                       
                    <a  href="{{route('about')}}"><li> हाम्रो बारे</li>   </a>
                        
                            <a  href="{{route('blogs')}}"><li> सूचना</li>   </a>

                     
                            <a  href="{{route('contact')}}"><li> सम्पर्क</li> </a>
                    </ul>
                </div>
                <i class="fas fa-arrow-left left-arrow" id="left-arrow"></i>
                <div class="black-layer" id="layer">
                </div>

            </div>

        </div>
    </nav>
