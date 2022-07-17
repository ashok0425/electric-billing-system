@extends('admin.layout.master')
@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
          <h6 class="card-title text-primary font-weight-bold"> Edit State</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <form action="{{route('admin.states.update',$state)}}" method="POST">
                        @method('PATCH')
                        @csrf
                        <div class="from-group">
                            @csrf
                            <label>Select Country</label>
                           <select name="country" id="" required class="form-control">
                            <option value="">--select Country--</option>
                            @foreach ($countries as $country)
                            <option value="{{$country->id}}" @if ($country->id=$state->country_id)
                                selected
                            @endif>{{$country->name}}</option>
                           @endforeach
                           </select>
                        </div>
                        <div class="from-group">
                            <label>State Name</label>
                            <input type="text" name="state" id="" class="form-control" required value="{{$state->name}}">
                        </div>
                        <br>
                        <input type="submit" class="btn btn-primary" value="save">
                    </form>
                </div>
            </div>

        </div>
    </div></div>
    
@endsection
