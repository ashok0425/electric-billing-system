@extends('admin.layout.master')
@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
          <h6 class="card-title text-primary font-weight-bold"> Edit Customer Detail</h6>
        </div>
        <div class="card-body">
          
                     <div class="row">

                        <div class="from-group my-2 col-md-6">
                            <label>Full Name</label> <br> 
                           {{$user->name}}
                        </div>

                        <div class="from-group my-2 col-md-6">
                            <label>Email</label> <br> 
                         {{$user->email}}
                        </div>

                        
                        <div class="from-group my-2 col-md-6">
                            <label>Phone number</label> <br> 
                      {{$user->detail->phone1}}
                        </div>

                        <div class="from-group my-2 col-md-6">
                            <label>Alternative Phone number</label> <br> 
                        {{$user->detail->phone2}}
                        </div>


                        <div class="from-group my-2 col-md-6">
                            <label> State</label> <br> 
                            {{$user->detail->state->name}}
                        
                        </div>


                        <div class="from-group my-2 col-md-6">
                            <label> District</label> <br> 
                         {{$user->detail->district->name}}
                              
                        </div>

                        <div class="from-group my-2 col-md-6">
                            <label>City</label> <br> 
                           {{$user->detail->city}}
                        </div>

                        <div class="from-group my-2 col-md-6">
                            <label>Address</label> <br> 
                          {{$user->detail->address}}
                        </div>


                        <div class="from-group my-2 col-md-6">
                            <label>Citizenship No</label> <br> 
                         {{$user->detail->citizenship_no}}
                        </div>
                        <div class="from-group my-2 col-md-6">
                            <label>Citizenship photo</label> <br> 
                          
                          <a href="{{asset($user->detail->citizenship_image)}}" download="citiozenship_{{$user->name}}">
                            <img src="{{asset($user->detail->citizenship_image)}}" alt="citizenship">
                          </a>
                        </div>

                        <div class="from-group my-2 col-md-6">
                            <label>Date of Birth</label> <br> 
                           {{$user->detail->custom_filed_1}}
                        </div>

                        <div class="from-group my-2 col-md-6">
                            <label>Citizenship issue District</label> <br> 
                           {{$user->detail->custom_filed_2}}
                        </div>

                        <div class="from-group my-2 col-md-6">
                            <label>Citizenship issue date</label> <br> 
                          {{$user->detail->custom_filed_3}}
                        </div>


                        <div class="from-group my-2 col-md-6">
                            <label>Status</label> <br> 
                         
                            @if ($user->status==0)
<div class="badge bg-danger text-white">Pending</div>
                                
                            @endif

                            @if ($user->status==1)
                            <div class="badge bg-success text-white">Active</div>
                                                            
                                                        @endif



                                                        @if ($user->status==2)
                                                        <div class="badge bg-primary text-white">Block</div>
                                                                                        
                                                                                    @endif
                        </div>
                     </div>
                       
       

        </div>
    </div></div>
    
@endsection
