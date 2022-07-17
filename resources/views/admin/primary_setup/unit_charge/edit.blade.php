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
<div class="row">
    <div class="col-md-6 offset-md-3">
        
        <form action="{{route('admin.unit_charges.update',$unit)}}" method="POST">
            @method('PATCH')
        

            <div class="from-group my-2">
                @csrf
                <label>From unit</label>
                <input type="number" name="from" id="" class="form-control" required value="{{$unit->from}}">
            </div>


            <div class="from-group my-2">
                @csrf
                <label>To unit</label>
                <input type="number" name="to" id="" class="form-control" required value="{{$unit->to}}">
            </div>


            <div class="from-group my-2">
                @csrf
                <label>Price per unit</label>
                <input type="text" name="price" id="" class="form-control" required value="{{$unit->price}}">
            </div>

            <input type="submit" class="btn btn-primary" value="save">
        </form>
    </div>
</div>

        </div>
    </div></div>
    
@endsection
