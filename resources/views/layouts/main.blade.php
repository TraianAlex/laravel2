<!DOCTYPE html>
<html>
<head>
<link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">
{!! Html::style('static/css/style.css') !!}
</head>
<body>
	<div class="container">
		@include('layouts.navigation')
		@if(Session::has('global'))
			<div class="row">
				<div class="col-md-5 col-md-offset-4">
					<p class="alert {{ Session::get('alert-class', 'alert-info') }}">
						{{ Session::get('global') }}
					</p>
				</div>
			</div>
		@endif
		<section>
			@yield('content')
		</section>
	</div>
	<script src="{{ asset('assets/js/vendor/jquery-1.11.2.min.js') }}"></script>
	<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
	{!! Html::script('static/js/script.js') !!}
</body>
</html>