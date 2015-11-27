<!DOCTYPE html>
<html>
<head>
{!! Html::script('static/js/script.js') !!}
{!! Html::style('static/css/style.css') !!}
</head>
<body>
	<nav>
		@section('navigation-bar')
		<a href="home">Home</a> | 
		<a href="/">App</a> | 
		@show

		@yield('navigation-bar')
	</nav>
	{!! Html::link('http://google.com', 'Google') !!}
	<img src="http://www.reestyle.net/vendor/reestyle/assets/php-logo.png">
	<section>
		@yield('content')
	</section>
</body>
</html>