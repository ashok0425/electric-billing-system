@extends('admin.layout.master')
@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
          <h6 class="card-title text-primary font-weight-bold"> Edit Customer Detail</h6>
        </div>
        <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
                    <form action="{{route('admin.user_details.update',$user->detail)}}" method="POST">
                        @method('PATCH')
                        @csrf
                     <div class="row">

                        <div class="from-group my-1 col-md-6">
                            <label>Full Name</label>
                            <input type="text" name="name" id="" class="form-control"  value="{{$user->name}}">
                        </div>

                        <div class="from-group my-1 col-md-6">
                            <label>Email</label>
                            <input type="email" name="email" id="" class="form-control"  value="{{$user->email}}">
                        </div>

                        
                        <div class="from-group my-1 col-md-6">
                            <label>Phone number</label>
                            <input type="number" name="phone1" id="" class="form-control"  value="{{$user->detail->phone1}}">
                        </div>

                        <div class="from-group my-1 col-md-6">
                            <label>Alternative Phone number</label>
                            <input type="number" name="phone2" id="" class="form-control"  value="{{$user->detail->phone2}}">
                        </div>



                        {{-- <div class="from-group my-1 col-md-6">
                            @csrf
                            <label>Select Country</label>
                           <select name="country" id=""  class="form-control">
                            @foreach ($countries as $country)
                            <option value="{{$country->id}}" >{{$country->name}}</option>
                           @endforeach
                           </select>
                        </div> --}}
                        <div class="from-group my-1 col-md-6">
                            <label>Select State</label>
                            <select name="state" id="state"  class="form-control select2">
                                <option value="">--select State--</option>
                                @foreach ($states as $state)
                                <option value="{{$state->id}}"
                                 @if ($state->id==$user->detail->state_id)
                                    selected
                                @endif>{{$state->name}}</option>
                               @endforeach
                               </select>
                        </div>


                        <div class="from-group my-1 col-md-6">
                            <label>Select District</label>
                            <select name="district" id="district"  class="form-control select2">
                                <option value="">--select district--</option>

                                @foreach ($districts as $district)
                                <option value="{{$district->id}}"
                                 @if ($district->id==$user->detail->district_id)
                                    selected
                                @endif>{{$district->name}}</option>
                               @endforeach
                               </select>
                        </div>

                        
                        @if (Auth::guard('admin')->user()->type=='admin')

                        <div class="from-group my-1 col-md-6">
                            <label>Select Branch/Franchise</label>
                            <select name="franchise_id" id="district"  class="form-control select2">
                                <option value="">--select State--</option>

                                @foreach ($franchises as $item)
                                <option value="{{$item->id}}"
                                    @if ($item->id==$user->franchise_id)
                                    selected
                                @endif
                                    >
                                    {{$item->name}},    
                                    {{$item->email}}

                                </option>
                                    
                                @endforeach

                               </select>
                        </div>
@endif



                        <div class="from-group my-1 col-md-6">
                            <label>City</label>
                           <input type="text" name="city"   class="form-control" value="{{$user->detail->city}}">
                        </div>

                        <div class="from-group my-1 col-md-6">
                            <label>Address</label>
                           <input type="text" name="address"  class="form-control" value="{{$user->detail->address}}">
                        </div>


                        <div class="from-group my-1 col-md-6">
                            <label>Citizenship No</label>
                           <input type="text" name="citizenship_no"  class="form-control" value="{{$user->detail->citizenship_no}}">
                        </div>
                        <div class="from-group my-1 col-md-6">
                            <label>Citizenship photo</label>
                           <input type="file" name="citizenship_image"  class="form-control"  value="">
                          <a href="{{asset($user->detail->citizenship_image)}}" download="citiozenship_{{$user->name}}">
                            <img src="{{asset($user->detail->citizenship_image)}}" alt="citizenship">
                          </a>
                        </div>

                        <div class="from-group my-1 col-md-6">
                            <label>Date of Birth</label>
                           <input type="text" name="dob"  class="datepicker form-control" value="{{$user->detail->custom_filed_1}}">
                        </div>

                        <div class="from-group my-1 col-md-6">
                            <label>Citizenship issue District</label>
                           <input type="text" name="citizen_issue_place"  class="form-control" value="{{$user->detail->custom_filed_2}}">
                        </div>

                        <div class="from-group my-1 col-md-6">
                            <label>Citizenship issue date</label>
                           <input type="text" name="citizen_issue_date"  class="datepicker form-control" value="{{$user->detail->custom_filed_3}}">
                        </div>


                        <div class="from-group my-1 col-md-6">
                            <label>Status</label>
                            <select name="status" id=""  class="form-control">
                                
                                <option value="0" @if ($user->status==0)
                                    selected
                                @endif>Pending</option>

                                <option value="1" @if ($user->status==1)
                                    selected
                                @endif>Active</option>
                                <option value="2" @if ($user->status==2)
                                    selected
                                @endif>Block</option>

                               </select>
                        </div>
                     </div>
                        <br>
                        <input type="submit" class="btn btn-primary" value="save">
                    </form>
       

        </div>
    </div></div>
    
@endsection

@push('scripts')
   <script>
     $(document).ready(function(){
 
        $('#state').on('change',function(){
            let id=$(this).val();
            $.ajax({
        url:'{{url('admin/load-district')}}',
        data:{id:id},
        success:function(res){
            console.log(res)
            $('#district').html(res)
        }
       })
        })
     })
   </script>
@endpush