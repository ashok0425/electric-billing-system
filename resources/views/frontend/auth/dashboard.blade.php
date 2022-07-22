@extends('admin.layout.master')

@section('content')
    {{-- {{dd()}} --}}
    <div class="alert alert-success">
        Login Successfull
    </div>

    <div class="row">

        <div class="col-md-3">
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





        <div class="col-md-3">
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

        <div class="col-md-3">
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



        <div class="col-md-3">
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
    </div>


    </div>
@endsection
