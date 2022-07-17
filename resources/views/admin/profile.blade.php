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
                    <form action="{{route('admin.franchises.update',['id'=>Auth::guard()->user()->id])}}" method="POST">
                        @csrf
                     <div class="row">

                        <div class="from-group my-1 col-md-6">
                            <label>Full Name</label>
                            <input type="text" name="name" id="" class="form-control" required value="{{Auth::guard()->user()->name}}">
                        </div>

                        <div class="from-group my-1 col-md-6">
                            <label>Email</label>
                            <input type="email" name="email" id="" class="form-control" required value="{{Auth::guard()->user()->email}}">
                        </div>

                        
                        <div class="from-group my-1 col-md-6">
                            <label>Change password</label>
                            <input type="password" name="password" id="" class="form-control"  value="">
                        </div>

                        <input type="hidden" name="status" value="1">

                        <div class="from-group my-1 col-md-6">

<label for=""></label>
                        <input type="submit" class="btn btn-primary btn-block" value="save">
                        </div>
                    </form>
       

        </div>
    </div></div>
    
@endsection
