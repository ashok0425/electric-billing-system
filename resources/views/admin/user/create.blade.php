@extends('admin.layout.master')
@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
          <h6 class="card-title text-primary font-weight-bold"> Create new  Customer </h6>
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
                    <form action="{{route('admin.user_details.store')}}" method="POST">
                        @csrf
                     <div class="row">

                        <div class="from-group my-1 col-md-6">
                            <label>Full Name</label>
                            <input type="text" name="name" id="" class="form-control" required value="{{old('name')}}">
                        </div>

                        <div class="from-group my-1 col-md-6">
                            <label>Email</label>
                            <input type="email" name="email" id="" class="form-control" required value="{{old('email')}}">
                        </div>

                        
                        <div class="from-group my-1 col-md-6">
                            <label>Phone number</label>
                            <input type="number" name="phone1" id="" class="form-control" required value="{{old('phone1')}}">
                        </div>

                        <div class="from-group my-1 col-md-6">
                            <label>Alternative Phone number</label>
                            <input type="number" name="phone2" id="" class="form-control" required value="{{old('phone2')}}">
                        </div>



                        {{-- <div class="from-group my-1 col-md-6">
                            @csrf
                            <label>Select Country</label>
                           <select name="country" id="" required class="form-control">
                            @foreach ($countries as $country)
                            <option value="{{$country->id}}" >{{$country->name}}</option>
                           @endforeach
                           </select>
                        </div> --}}
                        <div class="from-group my-1 col-md-6">
                            <label>Select State</label>
                            <select name="state" id="state" required class="form-control select2">
                                <option value="">--select State--</option>
                                @foreach ($states as $state)
                                <option value="{{$state->id}}" 
                                    @if (old('state')==$state->id)
                                        selected
                                    @endif
                                    >{{$state->name}}</option>
                               @endforeach
                               </select>
                        </div>


                        <div class="from-group my-1 col-md-6">
                            <label>Select District</label>
                            <select name="district" id="district" required class="form-control select2">
                                
                                <option value="">--select State--</option>
                               </select>
                        </div>

                        @if (Auth::guard('admin')->user()->type=='admin')

                        <div class="from-group my-1 col-md-6">
                            <label>Select Branch/Franchise</label>
                                
                            <select name="franchise_id" id="district" required class="form-control select2">
                                <option value="">--select State--</option>

                                @foreach ($franchises as $item)
                                <option value="{{$item->id}}">
                                    {{$item->name}},    
                                    {{$item->email}}

                                </option>
                                    
                                @endforeach

                               </select>
                        </div>

                        @endif


                        <div class="from-group my-1 col-md-6">
                            <label>City</label>
                           <input type="text" name="city" required  class="form-control" value="{{old('city')}}">
                        </div>

                        <div class="from-group my-1 col-md-6">
                            <label>Address</label>
                           <input type="text" name="address" required class="form-control" value="{{old('address')}}">
                        </div>


                        <div class="from-group my-1 col-md-6">
                            <label>Citizenship No</label>
                           <input type="text" name="citizenship_no" required class="form-control" value="{{old('citizenship_n')}}">
                        </div>
                        <div class="from-group my-1 col-md-6">
                            <label>Citizenship photo</label>
                           <input type="file" name="citizenship_image"  class="form-control"  value="">
                        
                        </div>

                        <div class="from-group my-1 col-md-6">
                            <label>Date of Birth</label>
                           <input type="text" name="dob" required class="date-picker form-control" >
                        </div>

                        <div class="from-group my-1 col-md-6">
                            <label>Citizenship issue District</label>
                           <input type="text" name="citizen_issue_place" required class="form-control" value="{{old('custom_field_2')}}">
                        </div>

                        <div class="from-group my-1 col-md-6">
                            <label>Citizenship issue date</label>
                           <input type="text" name="citizen_issue_date" required class="form-control datepicker" >
                        </div>


                        <div class="from-group my-1 col-md-6">
                            <label>Status</label>
                            <select name="status" id="" required class="form-control">
                                
                                <option value="0" @if (old('status')==0)
                                    selected
                                @endif>Pending</option>

                                <option value="1" @if (old('status')==1)
                                    selected
                                @endif>Active</option>
                                <option value="2" @if (old('status')==2)
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