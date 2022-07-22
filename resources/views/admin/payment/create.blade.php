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
        <label>select Meter ID</label>
       <select name="user" id="user" required class="form-control select2">

        <option value="">--select user--</option>

        @foreach ($users as $user)
        <option value="{{$user->id}}"
            @if (isset($id)&&$id!=null && $id==$user->id)
                selected
            @endif
            >{{$user->name}}, {{$user->meter_id}}</option>
            
        @endforeach
       </select>
    </div>



    <div class="from-group my-2 col-md-6 col-md-6">
        <label>Amount </label>
        <input type="text" name="amount" id="amount"    class="form-control" required autocomplete="off" min="1" >
    </div>

    <div class="from-group my-2 col-md-6 col-md-6">
        <label>Fine</label>
        <input type="text" name="fine" id="fine"  class="form-control" required autocomplete="off" >
    </div>

    <div class="from-group my-2 col-md-6">
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
    $('#user').on('change',function(){
        let id=$(this).val();
        getAmount(id);
    })
    let id=$('#user').val();
    getAmount(id);

    function getAmount(id){
        $.ajax({
            url:'{{url('admin/load-total-amount')}}',
            data:{id:id},
            type:'GET',
            success:function(res){
             $('#amount').val(res.price);
             $('#fine').val(res.fine);


            }
        })
    }
</script>
@endpush
