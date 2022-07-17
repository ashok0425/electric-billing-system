@extends('admin.layout.master')
@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
          <h6 class="card-title text-primary font-weight-bold"> Edit State</h6>
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
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <form action="{{route('admin.districts.update',$district)}}" method="POST">
                        @method('PATCH')
                        @csrf

                        <div class="from-group">
                            @csrf
                            <label>Select State</label>
                           <select name="state" id="" required class="form-control">
                            <option value="">--select State--</option>
                            @foreach ($states as $state)
                            <option value="{{$state->id}}" @if ($state->id=$district->state_id)
                                selected
                            @endif>{{$state->name}}</option>
                           @endforeach
                           </select>
                        </div>
                        <div class="from-group">
                            <label>State Name</label>
                            <input type="text" name="district" id="" class="form-control" required value="{{$district->name}}">
                        </div>
                        <br>
                        <input type="submit" class="btn btn-primary" value="save">
                    </form>
                </div>
            </div>

        </div>
    </div></div>
    
@endsection
