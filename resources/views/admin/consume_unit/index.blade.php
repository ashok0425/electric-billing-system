@extends('admin.layout.master')
@section('content')

<div class="container">
    <div class="card">
        <div class="card-header row">
            <div class="col-md-3">

          <h6 class="card-title text-primary my-1 font-weight-bold">List of Meter Reading</h6>
            </div>
          <div class="col-md-3">
          <a href="{{route('admin.consume_units.create')}}" class=" my-1 btn btn-primary"><i class="fa fa-plus"></i> Add New Reading</a>
          </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
<table class="table table-striped text-center" id="unit_table">
    <thead>
        <tr>
            <th>Meter Id</th>
            <th>Month</th>
            <th>Last Reading</th>
            <th>Current Reading</th>
            <th>unit</th>
            <th>Price</th>
            <th>Fine</th>
            <th>Due Date</th>

            <th>Status</th>
            {{-- <th>Action</th> --}}


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
        ajax: '{!! route('admin.consume_units.index') !!}',
        columns: [
            { data: 'customer', name: 'customer' },
            { data: 'month', name: 'month' },
            { data: 'last_meter_reading', name: 'last_meter_reading' },

{ data: 'current_total_unit', name: 'current_total_unit' },
            { data: 'unit', name: 'unit' },
            { data: 'price', name: 'price' },
            { data: 'fine', name: 'fine' },
            { data: 'due', name: 'due' },

            { data: 'status', name: 'status' },

            // { data: 'action', name: 'action' },

      
        ]
    });
});
    </script>    
@endpush
