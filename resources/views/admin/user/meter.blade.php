@extends('admin.layout.master')
@section('content')

<div class="container">
    <div class="card">
        <div class="card-header d-flex  justify-content-between">
          <h6 class="card-title text-primary my-1 font-weight-bold">Custmore Data List</h6>
          <a href="{{route('admin.user_details.create')}}" class=" my-1 btn btn-primary"><i class="fa fa-plus"></i> Add new</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
<table class="table table-striped text-center" id="user_table">
    <thead>
        <tr>
            <th>Meter Id</th>
            <th>Customer</th>
            <th>Is transferred</th>
            <th>Current Customer</th>
            <th>Register On</th>
            <th>Action</th>



        </tr>
    </thead>

</table>
</div>
        </div>

    </div>
</div>


@endsection

@push('scripts')

<script>
$(document).ready(function() {
    $('#user_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('admin.meter.index') !!}',
        columns: [
            { data: 'meter_id', name: 'meter_id' },
            { data: 'customer', name: 'customer' },
            { data: 'is_transfered', name: 'is_transfered' },
            { data: 'transfer_to', name: 'transfer_to' },      
            { data: 'created_at', name: 'created_at' },      
            { data: 'action', name: 'action' },      


        ]
    });
});
    </script>    
@endpush
