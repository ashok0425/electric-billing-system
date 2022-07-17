@extends('auth.layout')
@section('title')
    Register
@endsection
@section('content')
    <section>

<div class="container-fluid">

        <form method="post" class="log-form" action="{{ route('user.register') }}">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session()->has('message'))
            <div class="alert alert-{{session()->get('message')['alert-type']}}">
                {{      session()->get('message')['content']
                }}           
                </div>
            @endif
            @csrf
            <div class="group log-input">
                <input type="text" required name="first_name" placeholder="First name" autocomplete="off" value="{{old('first_name')}}">
            </div>

            <div class="group log-input">
                <input type="text" required name="last_name" placeholder="Last name" autocomplete="off" value="{{old('first_name')}}">
            </div>



            <div class="group log-input">
                <input type="email" required name="email" placeholder="Email address" autocomplete="off" value="{{old('first_name')}}">
            </div>



            <div class="group log-input">
                <input type="number" required name="mobile" placeholder="Phone number" autocomplete="off" value="{{old('mobile')}}">
            </div>

            <div class="group log-input">
                <select name="exam_type" required>
                    <option value="">--select Exam Type--</option>
                    <option value="UBT">UBT</option>
                    <option value="CBT">CBT</option>

                </select>
            </div>

            <div class="group log-input">
                <input type="password" required name="password" placeholder="Password" autocomplete="off" value="{{old('password')}}">
            </div>

            <div class="group log-input">
                <input type="password" required name="confirm_password" placeholder="Confirm password"
                    autocomplete="off" value="{{old('confirm_password')}}">
            </div>

            <input type="hidden"  name="course_type" value="exam">
            <div class="container-log-btn">
                <button type="submit" name="btn_submit" class="log-form-btn">
                    <span>Sign Up</span>
                </button>
            </div>

            <p class="text-center">Already have an Account.Sign In <a href="{{ route('user.login') }}">here</a></p>

        </form>
    </div>


    </section>
@endsection
