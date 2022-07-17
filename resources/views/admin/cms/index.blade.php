@extends('admin.layout.master')
@section('content')

<div class="card">
    <div class="card-header">
        <h6 class="text-primary">Update Website Information</h6>
    </div>

    <div class="card-body">
      <div class="container">
        <form action="{{ route('admin.cms.update') }}" method="POST" enctype="multipart/form-data">
@csrf
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label font-weight-bold">Meta Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Meta title" value="{{$cms->meta_title}}" >
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label font-weight-bold">Meta Keyword</label>
                    <input type="keyword" name="keyword" class="form-control" placeholder="Meta Keyword" value="{{$cms->keyword}}" >
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label font-weight-bold">Meta Description</label>
                    <input type="text" name="descr" class="form-control" placeholder="Meta Description" value="{{$cms->meta_description}}" >
                </div>
            </div>


            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label font-weight-bold">Website url</label>
                    <input type="url" name="url" class="form-control" placeholder="Website url" value="{{$cms->url}}" >
                </div>
            </div>
            
          <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label font-weight-bold">Company Register no</label>
                <input type="text" name="c_no" class="form-control" placeholder="Company Number" value="{{$cms->company_register_no}}" >
            </div>
        </div>
            <div class="col-md-6">

            <div class="mb-3">
                <label class="form-label font-weight-bold">Logo</label>
                <div class="file-upload-wrapper" data-text="Select your file!">
                    <input name="file" type="file" class="file-upload-field form-control" value="">
                  </div>
                  <br>
                  <img src="{{ asset($cms->logo) }}" width="70" alt="">
            </div>
            </div>
         

            <div class="col-md-6">

                <div class="mb-3">
                    <label class="form-label font-weight-bold">Fevicon</label>
                    <div class="file-upload-wrapper" data-text="Select your file!">
                        <input name="fev" type="file" class="file-upload-field  form-control" value="">
                      </div>
                      <br>
                      <img src="{{ asset($cms->fev) }}" width="70" alt="">
                </div>
                </div>
          
            <div class="col-md-6">
              <div class="mb-3">
                  <label class="form-label font-weight-bold">Copy  Right</label>
                  <input type="text" name="copy_right" class="form-control"  value="{{$cms->copy_right}}" >
                 
              </div>
          </div>

           
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fab fa-facebook-square"></i></span>
                    </div>
                    <input type="url" class="form-control" value="{{$cms->facebook}}" name="facebook">

                  </div>
            </div>
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fab fa-instagram-square"></i></span>
                    </div>
                    <input type="url" class="form-control" value="{{$cms->instagram}}" name="instagram">

                  </div>
            </div>
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fab fa-twitter-square"></i></span>
                    </div>
                    <input type="url" class="form-control" value="{{$cms->twitter}}" name="twitter">

                  </div>
            </div>

            <div class="col-md-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fab fa-linkedin"></i></span>
                    </div>
                    <input type="url" class="form-control" value="{{$cms->linkdin}}" name="linkdin">

                  </div>
            </div>

            <div class="col-md-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fab fa-tiktok"></i></span>
                    </div>
                    <input type="url" class="form-control" value="{{$cms->tiktok}}" name="tiktok">
                  </div>
            </div>

            <div class="col-md-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fab fa-youtube"></i></span>
                    </div>
                    <input type="url" class="form-control" value="{{$cms->youtube}}" name="youtube">

                  </div>
            </div>
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fab fa-pinterest"></i></span>
                    </div>
                    <input type="url" class="form-control" value="{{$cms->pinterest}}" name="pinterest">

                  </div>
            </div>
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Email 1</span>
                    </div>
                    <input type="email" class="form-control" value="{{$cms->email1}}" name="email1">

                  </div>
            </div>

            <div class="col-md-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Email 2</span>
                    </div>
                    <input type="email" class="form-control" value="{{$cms->email2}}" name="email2">

                  </div>
            </div>

            <div class="col-md-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Phone 1</span>
                    </div>
                    <input type="tel" class="form-control" value="{{$cms->phone1}}" name="phone1">
                  </div>
            </div>
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Phone 2</span>
                    </div>
                    <input type="tel" class="form-control" value="{{$cms->phone2}}" name="phone2">
                  </div>
            </div>
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Address 1</span>
                    </div>
                    <input type="text" class="form-control" value="{{$cms->address1}}" name="address1">
                  </div>
            </div>

            <div class="col-md-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Address 2</span>
                    </div>
                    <input type="text" class="form-control" value="{{$cms->address2}}" name="address2">
                  </div>
            </div>
            <div class="col-12">
                <label >About</label>
                <textarea name="about" id="summernote1" cols="30" rows="10">
                    {{$cms->about}}
                </textarea>
            </div>
            <div class="col-12">
                <label >Term & Condition</label>
                <textarea name="term" id="summernote2" cols="30" rows="10">
                    {{$cms->term}}

                </textarea>
            </div>

            <div class="col-12">
                <label >Private policy</label>
                <textarea name="policy" id="summernote3" cols="30" rows="10">
                    {{$cms->policy}}

                </textarea>
            </div>
         

            <input type="submit" value="update" class="btn btn-block btn-info">
        </div>
    </form>

      </div>
    </div>
</div>
@endsection
