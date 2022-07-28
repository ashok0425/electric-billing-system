@extends('admin.layout.master')
@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
          <h6 class="card-title text-primary font-weight-bold"> Edit charge per unit</h6>
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

        <form action="{{route('admin.consume_units.update',$unit)}}" method="POST">
            @method('PATCH')
            @csrf
        
<div class="row">
    
    <div class="from-group my-2 col-md-6 col-md-6">
        <label>select customer</label>
       <select name="user" id="" required class="form-control select2">

        <option value="">--select user--</option>

        @foreach ($users as $user)
        <option value="{{$user->id}}" @if ($user->id==$unit->user_id)
            selected
        @endif>{{$user->name}}</option>
            
        @endforeach
       </select>
    </div>




    <div class="from-group my-2 col-md-6 col-md-6">
        <label>Date From </label>
        <input type="text" name="from" id="" class="form-control datepicker" required value="{{$unit->from}}">
    </div>


    <div class="from-group my-2 col-md-6">
        <label>Date To </label>
        <input type="text" name="to" id="" class="form-control datepicker" required value="{{$unit->to}}">
    </div>


  
    <div class="from-group my-2 col-md-6">
        <label>Last Meter reading</label>
        <input type="number" name="last_meter_reading" id="last_meter_reading" class="form-control" required value="{{$unit->last_meter_reading}}">
    </div>

    <div class="from-group my-2 col-md-6">
        <label>Current Meter reading</label>
        <input type="number" name="current_total_unit" id="" class="form-control" required value="{{$unit->current_total_unit}}">
    </div>
    <div class="from-group my-2 col-md-6">
        <label> Meter reading Date</label>
        <input type="date" name="meter_reading_date" id="" class="form-control"  >
        <p>{{$unit->meter_reading_date}}</p>
    </div>
    <div class="from-group my-2 col-md-6">
        <label class="mt-4">
        <input type="checkbox" name="print" id="" class="font-weight-bold" value="1" checked>
        Print invoice
    </label>
    </div>
    

    <div class="from-group my-2 col-md-6">
        <label>Status</label>
       <select name="status" id="" class="form-control" required>
        <option value="0" @if ($unit->status==0)
            selected
        @endif>pendig</option>
        <option value="1" @if ($unit->status==1)
            selected
        @endif>Paid</option>
        <option value="2" @if ($unit->status==2)
            
        @endif>Partial paid</option>

       </select>
    </div>
</div>

            <input type="submit" class="btn btn-primary" value="save">
        </form>
   

        </div>
    </div></div>
    
@endsection
