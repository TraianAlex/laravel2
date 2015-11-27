@extends('layouts.main')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<form action="{{ URL::route('account-create-post')}}" method="POST" class="form-horizontal" role="form">
				<div class="form-group">
					<label class="col-md-4 control-label">Email</label>
					<div class="col-md-6">
						@if($errors->has('email'))
							<div class="alert alert-danger">
								{{ $errors->first('email')}}
							</div>
						@endif
						<input type="email" name="email" class="form-control" id="" placeholder="Email" value="{{ old('email') }}">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">Username</label>
					<div class="col-md-6">
						@if($errors->has('username'))
							<div class="alert alert-danger">
								{{ $errors->first('username')}}
							</div>
						@endif
						<input type="text" name="username" class="form-control" id="" placeholder="Username" value="{{ old('username') }}" required>
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
						<input type="password" name="password" class="form-control" id="" placeholder="Password" value="{{ e(Input::old('password')) }}">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">Confirm Password</label>
					<div class="col-md-6">
						@if($errors->has('password_again'))
							<div class="alert alert-danger">
								{{ $errors->first('password_again')}}
							</div>
						@endif
						<input type="password" name="password_confirmation" class="form-control" id="" placeholder="Confirm Password">
					</div>
				</div>
				<div class="col-md-6 col-md-offset-4">
					<button type="submit" class="btn btn-primary">Create account</button>
				</div>
				{!! Form::token() !!}
			</form>
		</div>
	</div>
</div>
@endsection