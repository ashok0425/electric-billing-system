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

        
        <form action="{{route('admin.transfer_meters.store')}}" method="POST">
            @csrf
        
<div class="row">
    
    <div class="from-group my-2 col-md-6 col-md-6">
        <label>Meter Id</label>
       <select name="meter_id" id="transfer_from" required class="form-control select2">

        <option value="">--select Meter ID--</option>

        @foreach ($users as $user)
        <option value="{{$user->id}}"
            @if (isset($id)&&$id!=null && $id=$user->id)
            selected
        @endif
            > {{$user->name}},{{$user->meter_id}}</option>
            
        @endforeach
       </select>
    </div>


    <div class="from-group my-2 col-md-6 col-md-6">
        <label>Meter Transfer To</label>
       <select name="transfer_to" id="" required class="form-control select2">

        <option value="">--select new customer--</option>

        @foreach ($users as $user)
        <option value="{{$user->id}}"
           
            >{{$user->name}},Customer_id: {{$user->costumer_id}}</option>
            
        @endforeach
       </select>
    </div>




    <div class="from-group my-2 col-md-6 col-md-6">
        <label>Total unit Till Now </label>
        <input type="text" name="total_unit" id="unit_till_now" class="form-control" required autocomplete="off" min="1" readonly  value="
        @if (isset($current_unit))
            {{$current_unit->current_total_unit}}
            @else 
            0
        @endif">
    </div>



    <div class="from-group my-2 col-md-6 col-md-6">
        <label>Transfer Charge </label>
        <input type="number" name="transfer_amount" id="" class="form-control" required autocomplete="off" min="1">
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

@push('scripts')
<script>
    $('#transfer_from').on('change',function(){
        let id=$(this).val();
        $.ajax({
            url:'{{url('admin/load-unit')}}',
            data:{id:id},
            type:'GET',
            success:function(res){
             $('#unit_till_now').val(res.unit);

            }
        })
    })
</script>
@endpush
