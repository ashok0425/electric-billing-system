@extends('admin.layout.master')
@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
          <h6 class="card-title text-primary font-weight-bold"> Create Country</h6>
        </div>
        <div class="card-body">
<div class="row">
    <div class="col-md-6 offset-md-3">
        
        <form action="{{route('admin.countries.store')}}" method="POST">
            <div class="from-group">
                @csrf
                <label>Country Name</label>
                <input type="text" name="country" id="" class="form-control" required>
            </div>
            <br>

            <input type="submit" class="btn btn-primary" value="save">
        </form>
    </div>
</div>

        </div>
    </div></div>
    
@endsection
