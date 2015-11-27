@extends('layouts.main')
@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<form class="form-horizontal" role="form" method="POST" action="{{ URL::route('account-forgot-password-post') }}">
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
					<div class="col-md-6 col-md-offset-4">
						<button type="submit" class="btn btn-primary">Recover</button>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection