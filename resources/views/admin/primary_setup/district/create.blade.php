@extends('admin.layout.master')
@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
          <h6 class="card-title text-primary font-weight-bold"> Create District</h6>
        </div>
        <div class="card-body">
<div class="row">
    <div class="col-md-6 offset-md-3">
        
        <form action="{{route('admin.districts.store')}}" method="POST">
            <div class="from-group">
                @csrf
                <label>Select State</label>
               <select name="state" id="" required class="form-control">
                <option value="">--select state--</option>
                @foreach ($states as $state)
                <option value="{{$state->id}}">{{$state->name}}</option>
               @endforeach
               </select>
            </div>
            <br>
            <div class="from-group">
                @csrf
                <label>District Name</label>
                <input type="text" name="district" id="" class="form-control" required>
            </div>
            <br>

            <input type="submit" class="btn btn-primary" value="save">
        </form>
    </div>
</div>

        </div>
    </div></div>
    
@endsection
