@extends('admin.layout.master')
@section('content')

<div class="container">
    <div class="card">
        <div class="card-header d-flex  justify-content-between">
          <h6 class="card-title text-primary my-1 font-weight-bold">Charge per unit Data List</h6>
          <a href="{{route('admin.unit_charges.create')}}" class=" my-1 btn btn-primary"><i class="fa fa-plus"></i> Add new</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
<table class="table table-striped text-center" id="unit_table">
    <thead>
        <tr>
            <th>From</th>
            <th>To</th>
            <th>Price</th>
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
    $('#unit_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('admin.unit_charges.index') !!}',
        columns: [
            { data: 'from', name: 'from' },
            { data: 'to', name: 'to' },
            { data: 'price', name: 'price' },

            { data: 'action', name: 'action' },

      
        ]
    });
});
    </script>    
@endpush
