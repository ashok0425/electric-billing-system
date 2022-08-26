@extends('admin.layout.master')

@section('content')
    {{-- {{dd()}} --}}
        <div class="alert alert-success">
            Login Successfull
        </div>
        
                <div class="row">
                 
                    <a class="col-md-3" href="{{route('admin.accounts.index')}}">
                        @php
    use carbon\carbon;

                            $month=DB::table('accounts')->sum('amount');
                        @endphp
                     <div class="card shadow-sm" style="border: 1.5px solid #005596">
                       
                        <div class="card-body">
                            <strong class="m-0 font-weight-bold text-primary pt-2 ">Total Collection</strong>

                         <h4 class="font-weignt-bold text-primary mt-2">
                           <i class="fas fa-rupee-sign"></i> {{$month}}
                         </h4>
                         
                    </div>
                </div>
            </a>




            
            <a class="col-md-3" href="{{route('admin.consume_units.index')}}">
                @php
                    $month=DB::table('consume_units')->sum('unit');
                @endphp
             <div class="card shadow-sm" style="border: 1.5px solid #005596">
               
                <div class="card-body">
                    <strong class="m-0 font-weight-bold text-primary pt-2 "> Total Consumptions</strong>

                 <h4 class="font-weignt-bold text-primary mt-2">
                    <i class="fas fa-faucet"></i> {{$month}}
                 </h4>
                 
            </div>
        </div>
    </a>

    <a class="col-md-3" href="{{route('admin.consume_units.index',['paid'=>1])}}">
        @php
            $month=DB::table('consume_units')->where('status',1)->sum('price');
        @endphp
     <div class="card shadow-sm" style="border: 1.5px solid #005596">
       
        <div class="card-body">
            <strong class="m-0 font-weight-bold text-primary pt-2 "> Paid Amount</strong>

         <h4 class="font-weignt-bold text-primary mt-2">
            <i class="fas fa-money-bill"></i> {{$month}}
         </h4>
         
    </div>
</div>
</a>


<a class="col-md-3" href="{{route('admin.consume_units.index',['paid'=>2])}}">
 
  @php
     $units=DB::table('consume_units')::where('user_id',$id)->where('status',0)->get();
          $fine=0;
  @endphp
        @foreach($units as $value)
         @php
              $fine+=__fine($value->created_at,today(),$value->price);
          $price+=$value->price;
         @endphp
  @endforeach
 <div class="card shadow-sm" style="border: 1.5px solid #005596">
   
    <div class="card-body">
        <strong class="m-0 font-weight-bold text-primary pt-2 ">Total Fine</strong>

     <h4 class="font-weignt-bold text-primary mt-2">
        <i class="fas fa-money-bill"></i> {{$fine}}
     </h4>
     
</div>
</div>
</a>


<a class="col-md-3" href="{{route('admin.consume_units.index',['paid'=>2])}}">

    @php
        $month=DB::table('consume_units')->where('status',0)->sum('price');
    @endphp
 <div class="card shadow-sm" style="border: 1.5px solid #005596">
   
    <div class="card-body">
        <strong class="m-0 font-weight-bold text-primary pt-2 ">  Due Amount</strong>

     <h4 class="font-weignt-bold text-danger mt-2">
        <i class="fas fa-money-bill"></i> {{$month}}
     </h4>
     
</div>
</div>
</a>
        </div>

        <div class="row mt-5">
            <div class="col-md-4">
                @include('admin.chart.unit')

            </div>

            <div class="col-md-8">
                @include('admin.chart.payment')

            </div>
        </div>
</div>

@endsection
