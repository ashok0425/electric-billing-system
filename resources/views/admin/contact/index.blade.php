@extends('admin.layout.master')
@section('content')

<div class="container">
    <div class="card">
        <div class="card-header d-flex  justify-content-between">
          <h6 class="card-title text-primary my-1 font-weight-bold">Contact List</h6>
          {{-- <a href="{{route('admin.accounts.create')}}" class=" my-1 btn btn-primary"><i class="fa fa-plus"></i> Add new</a> --}}
        </div>
        <div class="card-body">
            <div class="table-responsive">
<table class="table table-striped text-center" id="unit_table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Message</th>
            <th>Contact on</th>


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
        ajax: '{!! route('admin.contacts.index') !!}',
        columns: [
            { data: 'name', name: 'customer' },
            { data: 'email', name: 'amount' },
            { data: 'phone', name: 'month' },
            { data: 'message', name: 'message' },
            { data: 'created_at', name: 'created_at' },



            // { data: 'action', name: 'action' },

      
        ]
    });
});
    </script>    
@endpush
