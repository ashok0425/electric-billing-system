@extends('admin.layout.master')

@section('content')

        
                <div class="row">
                    @php
                        $user = session()->get('user');
                    @endphp
                    <div class="col-12">
                     <div class="card">
                        <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary pt-2 ">All Setup & Setting</h6>

                        </div>
                        <div class="card-body">
                       <div class="d-flex">
                        <a class="btn btn-primary mx-2" href="{{route('admin.countries.index')}}">
                            Country
                        </a>
                        <a class="btn btn-primary mx-2" href="{{route('admin.states.index')}}">
                            State
                        </a>

                        <a class="btn btn-primary mx-2" href="{{route('admin.districts.index')}}">
                            District
                        </a>

                        <a class="btn btn-primary mx-2" href="{{route('admin.unit_charges.index')}}">
                            Unit Charge
                        </a>
                       </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
