@extends('layouts.master')

@section('content')

    @include('layouts.inc.partials._banner2')

    <section class="cleaning-content-block" style="background-color: #f2f3f8 !important;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center">
                        <h2>Sign Up</h2>
                        <p>Sign up with Prestine</p>
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
                <div class="col-md-8 col-12">
                    <div class="card" style="padding: 25px;">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="signup-name" style="font-weight: 600;">Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="signup-name" name="name" required placeholder="Complete Name">
                                        </div><!-- End .form-group -->
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="signup-phone" style="font-weight: 600;">Phone <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="signup-phone" name="phone" required placeholder="Phone">
                                        </div><!-- End .form-group -->
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="signup-email" style="font-weight: 600;">Email <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="sigup-email" name="email" required placeholder="Email">
                                            <small>Enter unique email for your account.</small>
                                        </div><!-- End .form-group -->
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="signup-password" style="font-weight: 600;">Password <span class="text-danger">*</span></label>
                                            <input type="password" class="form-control" id="signup-password" name="password" required placeholder="Password">
                                            <small>Password must contain atleast 6 characters.</small>
                                        </div><!-- End .form-group -->
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="signup-confirm-password" style="font-weight: 600;">Confirm Password <span class="text-danger">*</span></label>
                                            <input type="password" class="form-control" id="signup-confirm-password" name="password_confirmation" required placeholder="Confirm Password">
                                        </div><!-- End .form-group -->
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <input type="checkbox" id="remember-me" name="terms" value="agree" required>
                                            <label for="remember-me"> I Agree with Prestine <a href="{{ route('terms_conditions') }}">Terms & Conditions</a></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-outline-primary btn-lg btn-block">
                                                <i class="fa fa-lock"></i>
                                                <span>Register</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="card-footer bg-white">
                            <p class="text-center">Already have an account?</p>
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <a href="{{ route('login') }}" class="btn btn-outline-danger btn-block">
                                        Login
                                    </a>
                                </div>
                            </div><!-- End .row -->
                        </div>
                    </div>
                </div>
            </div><!-- End .form-box -->
        </div>
    </section>
 









<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->
@endsection
