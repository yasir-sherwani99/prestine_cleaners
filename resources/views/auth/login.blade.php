@extends('layouts.master')

@section('content')

    @include('layouts.inc.partials._banner2')

    <section class="cleaning-content-block" style="background-color: #f2f3f8 !important;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center">
                        <h2>Login</h2>
                        <p>Login with Prestine</p>
                    </div>
                </div>
            </div>
            @if (count($errors) > 0)
                <div class="row justify-content-center">
                    <div class="col-md-5 col-12">
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <b>Alert!</b>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
            @if(session()->has('logout'))
            <div class="row justify-content-center">
                <div class="col-md-5 col-12">
                    <div class="alert bg-danger alert-dismissible" role="alert">
                        <button type="button" class="close text-white" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <span class="text-white">{{ session()->get('logout') }}</span>
                    </div>
                </div>
            </div>
            @endif
            @if(session()->has('success'))
            <div class="row justify-content-center">
                <div class="col-md-5 col-12">
                    <div class="alert bg-success alert-dismissible" role="alert">
                        <button type="button" class="close text-white" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <span class="text-white">{{ session()->get('success') }}</span>
                    </div>
                </div>
            </div>
            @endif         
            <div class="row justify-content-center">
                <div class="col-md-5 col-12">
                    <div class="card" style="padding: 25px;">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="singin-email-2" style="font-weight: 600;">Email <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="singin-email-2" name="email" required placeholder="Email">
                                </div><!-- End .form-group -->

                                <div class="form-group">
                                    <label for="singin-password-2" style="font-weight: 600;">Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" id="singin-password-2" name="password" required placeholder="Password">
                                </div><!-- End .form-group -->
                                
                                <div class="form-group row">
                                    <div class="col-md-6 col-12 text-left">
                                        <input type="checkbox" id="remember-me" class="chk-remember">
                                        <label for="remember-me"> Remember Me</label>
                                    </div>
                                    <div class="col-md-6 col-12 text-right">
                                        <a href="{{ route('password.request') }}" class="card-link">Forgot Password?</a>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-outline-primary btn-lg btn-block">
                                        <i class="fa fa-lock"></i>
                                        <span>Log In</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div class="card-footer bg-white">
                            <p class="text-center">Don't have an account?</p>
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <a href="{{ route('register') }}" class="btn btn-outline-danger btn-block">
                                        Register
                                    </a>
                                </div>
                            </div><!-- End .row -->
                        </div>
                    </div>
                </div>
            </div><!-- End .form-box -->
        </div>
    </section>
        
@endsection
