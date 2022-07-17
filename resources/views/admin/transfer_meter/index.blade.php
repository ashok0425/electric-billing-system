@extends('admin.layout.master')
@section('content')

<div class="container">
    <div class="card">
        <div class="card-header d-flex  justify-content-between">
          <h6 class="card-title text-primary my-1 font-weight-bold">Meter Transfer History</h6>
          <a href="{{route('admin.transfer_meters.create')}}" class=" my-1 btn btn-primary"><i class="fa fa-plus"></i> Transfer More</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
<table class="table table-striped text-center" id="unit_table">
    <thead>
        <tr>
            <th>Transfer From</th>
            <th>Transfer To</th>
            <th>Meter Id</th>
            <th>Meter Reading</th>
            <th>Amount paid</th>
            <th>Transferred On</th>


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
    $('#unit_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('admin.transfer_meters.index') !!}',
        columns: [
            { data: 'transfer_from', name: 'transfer_from' },
            { data: 'transfer_to', name: 'transfer_to' },
            { data: 'meter_id', name: 'meter_id' },
            { data: 'total_unit', name: 'total_unit' },
            { data: 'transfer_amount', name: 'transfer_amount' },
            { data: 'created_at', name: 'created_at' },


      
        ]
    });
});
    </script>    
@endpush
