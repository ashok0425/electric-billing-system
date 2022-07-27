@extends('admin.layout.master')
@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title text-primary font-weight-bold"> Add Blog/Notice</h6>
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


                <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">

                        <div class="from-group my-2 col-md-6 col-md-6">
                            <label>Type </label>
                           <select name="type" id="" class="form-control">
                            <option value="">--select Type--</option>
                            <option value="1">Notice</option>
                            <option value="2">Banner</option>
                            <option value="3">Team</option>
v
                           </select>
                        </div>
                        <div class="from-group my-2 col-md-6 col-md-6">
                            <label>Position (Only if Type is team)</label>
                            <input type="text" name="position" class="form-control"  autocomplete="off" >
                        </div>
                        <div class="from-group my-2 col-md-6 col-md-6">
                            <label>Title (name if type is team)</label>
                            <input type="text" name="title" class="form-control" required autocomplete="off" required>
                        </div>

                       



                        <div class="from-group my-2 col-md-6 col-md-6">
                            <label>Thumbnail </label>
                            <input type="file" name="thumbnail" id="" class="form-control" required>
                        </div>


                        <div class="from-group my-2 col-12">
                            <label>Description </label>
                            <textarea name="description" id="summernote1" cols="30" rows="10"></textarea>
                        </div>
                    </div>

                    <input type="submit" class="btn btn-primary" value="save">
                </form>


            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $('#transfer_from').on('change', function() {
            let id = $(this).val();
            $.ajax({
                url: '{{ url('admin/load-unit') }}',
                data: {
                    id: id
                },
                type: 'GET',
                success: function(res) {
                    $('#unit_till_now').val(res.unit);

                }
            })
        })
    </script>
@endpush
