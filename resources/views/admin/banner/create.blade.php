@extends('admin.layout.master')
@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
          <h6 class="card-title text-primary font-weight-bold"> Add Banner</h6>
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

        
        <form action="{{route('admin.blogs.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
        
<div class="row">

    <div class="from-group my-2 col-md-6 col-md-6">
        <label>Title </label>
        <input type="text" name="title" class="form-control" required autocomplete="off" required>
    </div>



    <div class="from-group my-2 col-md-6 col-md-6">
        <label>Thumbnail </label>
        <input type="file" name="thumbnail" id="" class="form-control" required >
    </div>

<br>
            <input type="submit" class="btn btn-primary" value="save">
        </form>
   

        </div>
    </div></div>
    
@endsection

@push('scripts')
<script>
    $('#transfer_from').on('change',function(){
        let id=$(this).val();
        $.ajax({
            url:'{{url('admin/load-unit')}}',
            data:{id:id},
            type:'GET',
            success:function(res){
             $('#unit_till_now').val(res.unit);

            }
        })
    })
</script>
@endpush
