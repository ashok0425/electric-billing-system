<section class="contact--section container shadow p-3 py-5 my-5 ">

    <div class="row ">
        <div class="section--box col-md-6">
            <div class="section--title px-4 pt-4">
                <div class="title">
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