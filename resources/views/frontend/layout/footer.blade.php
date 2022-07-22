@php
$cms = DB::table('cms')->first();
@endphp
<!-- Footer -->
<footer class="custom-bg-primary custom-text-lightgray footer">
    <div class="container">
        <div class="top-footer">
            <div class="row">
                <div class="col-md-3 d-flex">

                    <div class="footer-content">
                        <div class="footer-title">
                            <div class="img-wrap pt-3">
                                <a href="{{route('/')}}">
                                    <img src="{{ asset($cms->logo) }}" alt="logo" class="img-fluid">
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-sm-4 d-flex">
                            <div class="footer-items">
                                <h2 class="mb-1">लिङ्कहरू</h2>
                                <ul class="footer-links pt-1">
                                    <a href="{{ route('/') }}">

                                        <li> होमपेज
                                        <li>
                                    </a>


                                    <a href="{{ route('about') }}">
                                        <li> हाम्रो बारे</li>
                                    </a>

                                    <a href="{{ route('blogs') }}">
                                        <li> सूचना</li>
                                    </a>

                                    <a href="{{ route('contact') }}">
                                        <li> सम्पर्क</li>
                                    </a>
                                </ul>
                            </div>

                        </div>
                        <div class="col-sm-4 d-flex">
                            <div class="footer-items">
                                <h2 class="mb-1">सम्पर्क</h2>
                                <ul class="footer-links pt-1">
                                    <a class="active" aria-current="page" href="mailto:">

                                        <li> <i class="fas fa-home"></i> &nbsp; {{ $cms->address1 }}</li>
                                    </a>
                                    <a class="active" aria-current="page" href="tel:{{ $cms->phone1 }}" class="text-light">

                                        <li> <i class="fas fa-phone-alt"></i> &nbsp; {{ $cms->phone1 }}
                                        </li>
                                    </a>
                                    <a href="mailto:{{ $cms->email1 }}" class="text-light">
                                        <li> <i class="fas fa-envelope"></i> &nbsp; {{ $cms->email1 }}
                                        <li>
                                    </a>



                                    </a>



                                </ul>
                            </div>

                        </div>


                        <div class="col-sm-4 d-flex">
                            <div class="footer-items">
                                <h2 class="mb-1">सामाजिक सञ्जाल</h2>
                                <ul class="footer-links pt-1">
                                    <a href="{{ $cms->facebook }}" class="text-light">
                                        <li> <i class="fab fa-facebook"></i> &nbsp; Facebook
                                        <li>
                                    </a>
                                    <a href="{{ $cms->facebook }}" class="text-light">
                                        <li> <i class="fab fa-instagram"></i> &nbsp; instagram
                                        <li>
                                    </a>

                                    <a href="{{ $cms->facebook }}" class="text-light">
                                        <li> <i class="fab fa-twitter"></i> &nbsp; twitter
                                        <li>
                                    </a>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    {{-- <div class="bottom-footer custom-bg-dark-primary">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <a href="/about-us/">हाम्रोबारे</a> <a href="#">प्रयोगका शर्त </a> <a
                            href="/advertise-with-us/">विज्ञापन</a> <a href="/privacy-policy/">Privacy Policy</a> <a
                            href="/contact-us/">सम्पर्क</a>
                    </div>
                    <div class="col-md-6 text-start text-md-end">
                        <p>© २००६-२०२१ Onlinekhabar.com सर्वाधिकार सुरक्षित
                        </p>
                    </div>
                </div>
            </div>
        </div> --}}
</footer>
