@extends('frontend.auth.layout.master')
@section('content')
@php
use App\Models\ConsumeUnit;
      $units=ConsumeUnit::where('user_id',Auth::user()->id)->where('status',0)->get();
        $fine=0;
        $price=0;
           foreach($units as $value){
            $fine+=__fine($value->created_at,today(),$value->price);
            $price+=$value->price;

           }
           @endphp
<div class="container">
    
<div class="row">
    <div class="col-md-6 offset-md-3">
    <div class="card">
        <div class="card-header">
          <h6 class="card-title text-primary font-weight-bold">Make  payment</h6>
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
        
    
   
    <div class="from-group my-2 ">
        <label>Amount </label>
        <input type="text" name="amount" id="amount"    class="form-control" required autocomplete="off" min="1" readonly value="{{$price}}">
    </div>

    <div class="from-group my-2 ">
        <label>Fine</label>
        <input type="text" name="fine" id="fine"  class="form-control" required autocomplete="off" readonly value="{{$fine}}"> 
    </div>

    <div class="from-group my-2">
        <label>Remarks </label>
       <input type="text" name="remark" id="" class="form-control">

    </div>
    <div class="from-group my-2 ">

            <input type="submit" class="btn btn-primary btn-block" value="save">
    </div>

        </form>
   
</div></div>
</div>

        </div>
    </div></div>
    
@endsection

