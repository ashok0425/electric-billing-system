@extends('admin.layout.master')
@section('content')

<div class="container">
    <div class="card">
        <div class="card-header d-flex  justify-content-between">
          <h6 class="card-title text-primary my-1 font-weight-bold">Payment List</h6>
          <a href="{{route('admin.accounts.create')}}" class=" my-1 btn btn-primary"><i class="fa fa-plus"></i> Add new</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
<table class="table table-striped text-center" id="unit_table">
    <thead>
        <tr>
            <th>Meter Id</th>
            <th>Acutal Amount</th>
            <th>Fine Amount</th>
            <th>Total Amount</th>
            <th>Paid on</th>
            <th>Voucher No</th>
            <th>Remark</th>
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
        dom:'Bfrtip',
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
        serverSide: true,
        ajax: '{!! route('admin.accounts.index') !!}',
        columns: [
            { data: 'customer', name: 'customer' },
            { data: 'amount', name: 'amount' },
            { data: 'fine', name: 'fine' },
            { data: 'total', name: 'total' },
            { data: 'month', name: 'month' },
            { data: 'voucher_no', name: 'voucher_no' },
            { data: 'remarks', name: 'remarks' },
            { data: 'action', name: 'action' },

      
        ]
    });
});
    </script>    
@endpush
