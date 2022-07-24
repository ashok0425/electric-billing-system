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
    {{-- {{dd()}} --}}
    <div class="alert alert-success">
        Login Successfull
    </div>
<div class="row">
    <div class="col-md-6 order-2 order-md-1">

    
    <div class="row">

        <div class="col-md-6 my-2">
            @php
                use carbon\carbon;
                
                $month = DB::table('accounts')
                    ->where('user_id', Auth::user()->id)
                    ->sum('amount');
            @endphp
            <div class="card shadow-sm" style="border: 1.5px solid #005596">

                <div class="card-body">
                    <strong class="m-0 font-weight-bold text-primary pt-2 ">Total paid Amount</strong>

                    <h4 class="font-weignt-bold text-primary mt-2">
                        <i class="fas fa-rupee-sign"></i> {{ $month }}
                    </h4>

                </div>
            </div>
        </div>





        <div class="col-md-6 my-2">
            @php
                $month = DB::table('consume_units')->sum('unit');
            @endphp
            <div class="card shadow-sm" style="border: 1.5px solid #005596">

                <div class="card-body">
                    <strong class="m-0 font-weight-bold text-primary pt-2 ">
                        Total Meter Reading
                    </strong>

                    <h4 class="font-weignt-bold text-primary mt-2">
                        <i class="fas fa-faucet"></i> {{ $month }}
                    </h4>

                </div>
            </div>
        </div>

        <div class="col-md-6 ny-2">
            @php
                $month = DB::table('consume_units')
                    ->whereYear('created_at', carbon::now()->year)
                    ->whereMonth('created_at', Carbon::now()->month)
                    ->where('user_id', Auth::user()->id)
                    ->sum('unit');
            @endphp
            <div class="card shadow-sm" style="border: 1.5px solid #005596">

                <div class="card-body">
                    <strong class="m-0 font-weight-bold text-primary pt-2 ">This month Reading</strong>

                    <h4 class="font-weignt-bold text-primary mt-2">
                        <i class="fas fa-money-bill"></i> {{ $month }}
                    </h4>

                </div>
            </div>
        </div>



        <div class="col-md-6 my-2">
            @php
                $month = DB::table('consume_units')
                    ->where('user_id', Auth::user()->id)
                    ->where('status', 0)
                    ->sum('price');
            @endphp
            <div class="card shadow-sm" style="border: 1.5px solid #005596">

                <div class="card-body">
                    <strong class="m-0 font-weight-bold text-primary pt-2 ">Due Amount</strong>

                    <h4 class="font-weignt-bold text-danger mt-2">
                        <i class="fas fa-money-bill"></i> {{ $month }}
                    </h4>

                </div>
            </div>
        </div>

        
        <div class="col-md-6 my-2">
            @php
                $month = DB::table('consume_units')
                    ->where('user_id', Auth::user()->id)
                    ->where('status', 0)
                    ->sum('price');
            @endphp
            <div class="card shadow-sm" style="border: 1.5px solid #005596">

                <div class="card-body">
                    <strong class="m-0 font-weight-bold text-primary pt-2 ">Fine Amount</strong>

                    <h4 class="font-weignt-bold text-danger mt-2">
                        <i class="fas fa-money-bill"></i> {{ $fine }}
                    </h4>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6 order-1 order-md-2">
    <div class="row">
        <div class="col-md-8 offset-md-2">


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
            
    
    
        <div class="from-group my-2  ">
            <label>Amount </label>
            <input type="text" name="amount" id="amount"    class="form-control" required autocomplete="off" min="1" readonly value="{{$price}}">
        </div>
    
        <div class="from-group my-2 ">
            <label>Fine</label>
            <input type="text" name="fine" id="fine"  class="form-control" required autocomplete="off" readonly value="{{$fine}}">
        </div>
    
        <div class="from-group my-2 ">
            <label>Remarks </label>
           <input type="text" name="remark" id="" class="form-control">
    
        </div>
    
                <input type="submit" class="btn btn-primary btn-block" value="save">
            </form>
       
    
            </div>
        </div>
        
    </div>
</div>
</div>
</div>

   
@endsection
