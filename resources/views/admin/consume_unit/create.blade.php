@extends('admin.layout.master')
@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
          <h6 class="card-title text-primary font-weight-bold"> Add New Reading</h6>
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

        
        <form action="{{route('admin.consume_units.store')}}" method="POST">
            @csrf
        
<div class="row">
    
    <div class="from-group my-2 col-md-6 col-md-6">
        <label>select customer</label>
       <select name="user" id="user" required class="form-control select2">

        <option value="">--select user--</option>

        @foreach ($users as $user)
        <option value="{{$user->id}}" >{{$user->name}},{{$user->meter_id}}</option>
            
        @endforeach
       </select>
    </div>




    <div class="from-group my-2 col-md-6 col-md-6">
        <label>Date From </label>
        <input type="text" name="from" id="" class="form-control datepicker" required autocomplete="off">
    </div>


    <div class="from-group my-2 col-md-6">
        <label>Date To </label>
        <input type="text" name="to" id="" class="form-control datepicker" required autocomplete="off">
    </div>


    <div class="from-group my-2 col-md-6">
        <label>Last Meter reading</label>
        <input type="number" name="last_meter_reading" id="last_meter_reading" class="form-control" required >
    </div>

    <div class="from-group my-2 col-md-6">
        <label>Current Meter reading</label>
        <input type="number" name="current_total_unit" id="" class="form-control" required >
    </div>

    <div class="from-group my-2 col-md-6">
        <label class="mt-4">
        <input type="checkbox" name="print" id="" class="font-weight-bold" value="1" checked>
        Print invoice
    </label>
    </div>
</div>

            <input type="submit" class="btn btn-primary" value="save">
        </form>
   

        </div>
    </div></div>
    
@endsection


@push('scripts')
<script>
    $(document).on('change','#user',function(){
        let id=$(this).val();
if(id!=''){
    $.ajax({
            url:'{{url('admin/load-last-meter')}}',
            data:{id:id},
            type:'GET',
            success:function(res){
                console.log(res)
             $('#last_meter_reading').val(res);

            }
        })
}else{
    $('#last_meter_reading').val(0);

}
       
    })
</script>
@endpush