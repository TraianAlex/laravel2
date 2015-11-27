@extends('layouts.main')
@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<form class="form-horizontal" role="form" method="POST" action="{{ URL::route('account-sign-in-post') }}">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">

				<div class="form-group">
					<label class="col-md-4 control-label">E-Mail Address</label>
					<div class="col-md-6">
						@if($errors->has('email'))
							<div class="alert alert-danger">
								{{ $errors->first('email')}}
							</div>
						@endif
						<input type="email" class="form-control" name="email" value="{{ old('email') }}">
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-4 control-label">Password</label>
					<div class="col-md-6">
						@if($errors->has('password'))
							<div class="alert alert-danger">
								{{ $errors->first('password')}}
							</div>
						@endif
						<input type="password" class="form-control" name="password">
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-6 col-md-offset-4">
						<div class="checkbox">
							<label>
								<input type="checkbox" name="remember"> Remember Me
							</label>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-6 col-md-offset-4">
						<button type="submit" class="btn btn-primary">Login</button>

						<a class="btn btn-link" href="{{ URL::route('account-forgot-password') }}">Forgot Your Password?</a>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection