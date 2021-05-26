@extends('layouts.admin_login')

@section('content')

<section class="flexbox-container">
    <div class="col-12 d-flex align-items-center justify-content-center">
        <div class="col-md-4 col-10 p-0">
            @if (count($errors) > 0)
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <b><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Alert!</b>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-icon-left alert-arrow-left alert-danger alert-dismissible mb-2" role="alert">
                    <span class="alert-icon"><i class="la la-thumbs-o-down text-bold-600"></i></span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>Oh Snap!</strong> <span class="text-bold-600">{{ session('error') }}</span>
                </div>
            @endif
            @if (session()->has('alert'))
                <div class="alert bg-danger alert-dismissible mb-2" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>Oh Snap!</strong> {{ session()->get('alert') }}
                </div>
            @endif

            <div class="card border-grey border-lighten-3 box-shadow-2 m-0">
                <div class="card-header border-0">
                  	<div class="card-title text-center">
                    	<div class="p-1">
                          <a href="{{ url('/') }}">
                      		  <img src="{{ asset('assets/img/logo/prestine_logo_2.png') }}" alt="Prestine logo">
                          </a>
                    	</div>
                  	</div>
                  	<h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                    	<span>Admin Panel</span>
                  	</h6>
                </div>
                <div class="card-content">
                  	<div class="card-body">
                    	<form class="form-horizontal form-simple" method="POST" action="{{ route('admin.login.store') }}" novalidate>
                            @csrf
                      		<fieldset class="form-group position-relative has-icon-left mb-0">
                        		<input type="text" name="email" class="form-control form-control-lg input-lg rounded-bottom" id="user-name" data-validation-required-message="Username field is required." placeholder="Email" required>
                        		<div class="form-control-position">
                          			<i class="ft-mail"></i>
                        		</div>
                                <div class="help-block font-small-3 my-1"></div>
                      		</fieldset>
                      		<fieldset class="form-group position-relative has-icon-left">
                        		<input type="password" name="password" class="form-control form-control-lg input-lg rounded-top" id="user-password" data-validation-required-message="Password field is required." placeholder="Password" required>
                        		<div class="form-control-position">
                          			<i class="la la-key"></i>
                        		</div>
                                <div class="help-block font-small-3"></div>
                      		</fieldset>
                      		<div class="form-group row">
                        		<div class="col-md-6 col-12 text-center text-md-left">
                          			<fieldset>
                            			<input type="checkbox" id="remember-me" class="chk-remember">
                            			<label for="remember-me"> Remember Me</label>
                          			</fieldset>
                        		</div>
                        		<div class="col-md-6 col-12 text-center text-md-right"><a href="#" class="card-link">Forgot Password?</a></div>
                      		</div>
                      		<button type="submit" class="btn btn-info btn-lg btn-block"><i class="ft-unlock"></i> Login</button>
                    	</form>
                  	</div>
                </div>
                <div class="card-footer">
                  	<div class="">
                    	<p class="float-sm-left text-center m-0"><a href="#" class="card-link">Recover password</a></p>
                  	</div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection