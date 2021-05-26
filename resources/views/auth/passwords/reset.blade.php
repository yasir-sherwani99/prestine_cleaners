@extends('layouts.master')

@section('content')

    @include('layouts.inc.partials._banner2')

    <section class="cleaning-content-block" style="background-color: #f2f3f8 !important;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center">
                        <h2>Reset Password</h2>
                        <p>Please enter your new password twice so we can verify you typed it in correctly.</p>
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
            <div class="row justify-content-center">
                <div class="col-md-5 col-12">
                    <div class="card" style="padding: 25px;">
                        <form method="POST" action="{{ route('reset.password.user') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $reset->token }}">
                            <input type="hidden" name="email" id="email" value="{{ $reset->email }}">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="singin-password-2" style="font-weight: 600;">New Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" id="singin-password-2" name="password" required placeholder="New Password">
                                    <small>Password must contain at least 6 characters</small>
                                </div><!-- End .form-group -->

                                <div class="form-group">
                                    <label for="singin-password-2" style="font-weight: 600;">Confirm New Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" id="singin-password-2" name="password_confirmation" required placeholder="Re-enter new Password">
                                </div><!-- End .form-group -->

                                <div class="form-group mt-4">
                                    <button type="submit" class="btn btn-outline-primary btn-lg btn-block">
                                        <i class="fa fa-lock"></i>
                                        <span>Reset Password</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- End .form-box -->
        </div>
    </section>

@endsection