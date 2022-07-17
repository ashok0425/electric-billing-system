@extends('admin.layout.master')
@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
          <h6 class="card-title text-primary font-weight-bold"> Add payment</h6>
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

        
        <form action="{{route('admin.accounts.store')}}" method="POST">
            @csrf
        
<div class="row">
    
    <div class="from-group my-2 col-md-6 col-md-6">
        <label>select customer</label>
       <select name="user" id="" required class="form-control select2">

        <option value="">--select user--</option>

        @foreach ($users as $user)
        <option value="{{$user->id}}"
            @if (isset($id)&&$id!=null && $id=$user->id)
                selected
            @endif
            >{{$user->name}},Meter_id: {{$user->meter_id}}</option>
            
        @endforeach
       </select>
    </div>




    <div class="from-group my-2 col-md-6 col-md-6">
        <label>Amount </label>
        <input type="number" name="amount" id="" class="form-control" required autocomplete="off" min="1">
    </div>


    <div class="from-group my-2 col-12">
        <label>Remarks </label>
       <input type="text" name="remark" id="" class="form-control">

    </div>
</div>

            <input type="submit" class="btn btn-primary" value="save">
        </form>
   

        </div>
    </div></div>
    
@endsection
