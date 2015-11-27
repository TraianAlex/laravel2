@extends('layouts.main')
@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<form class="form-horizontal" role="form" method="POST" action="{{ URL::route('account-change-password-post') }}">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="form-group">
					<label class="col-md-4 control-label">Old password</label>
					<div class="col-md-6">
						@if($errors->has('old_password'))
							<div class="alert alert-danger">
								{{ $errors->first('old_password')}}
							</div>
						@endif
						<input type="password" class="form-control" name="old_password">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">New password</label>
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
					<label class="col-md-4 control-label">Confirm password</label>
					<div class="col-md-6">
						@if($errors->has('password_confirmation'))
							<div class="alert alert-danger">
								{{ $errors->first('password_confirmation')}}
							</div>
						@endif
						<input type="password" class="form-control" name="password_confirmation">
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-6 col-md-offset-4">
						<button type="submit" class="btn btn-primary">Login</button>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection