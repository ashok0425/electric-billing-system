@extends('admin.layout.master')
@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
          <h6 class="card-title text-primary font-weight-bold"> Edit Country</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <form action="{{route('admin.countries.update',$country)}}" method="POST">
                        @method('PATCH')
                        @csrf
                        <div class="from-group">
                            <label>Country Name</label>
                            <input type="text" name="country" id="" class="form-control" required value="{{$country->name}}">
                        </div>
                        <br>
                        <input type="submit" class="btn btn-primary" value="save">
                    </form>
                </div>
            </div>

        </div>
    </div></div>
    
@endsection
