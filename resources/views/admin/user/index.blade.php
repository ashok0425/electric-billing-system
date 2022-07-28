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
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Status</th>

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
        dom:'Bfrtip',
        lengthMenu: [
					[10, 25, 50, -1],
					['10 row', '25 row', '50 row', 'All Rows']
				],
         buttons: [{
                        extend: 'print',
                        exportOptions: {
                            stripHtml: false,
                            columns: ':visible:not(:last-child)'
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            stripHtml: false,
                            columns: ':visible:not(:last-child)'
                        }
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            stripHtml: false,
                            columns: ':visible:not(:last-child)'
                        }
                    },

                    {
                        extend: 'colvis',

                    },
                    'pageLength',
                ],
        ajax: '{!! route('admin.user_details.index') !!}',
        columns: [
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'phone1', name: 'user_details.phone1' },
            { data: 'status', name: 'users.status' },

            { data: 'created_at', name: 'created_at' },

            { data: 'action', name: 'action' },

      
        ]
    });
});
    </script>    
@endpush
