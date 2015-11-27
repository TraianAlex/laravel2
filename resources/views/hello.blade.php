<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		h1 {color: red;}
	</style>
</head>
<body>
	@if (isset($var))
		<h1>{{ $var }}</h1>
	@endif

	@if (isset($friends))
		@if (count($friends) === 1)
			I have a friend called {{ $friends[0] }}
		@elseif (count($friends) > 1)
			@foreach ($friends as $friend)
				I have a friend called: {{ $friend }}
				<br>
			@endforeach
		@else
			I'm very lonely
		@endif

		@while(list($friend) = each($friends))
			This is probably a bad idea. {{ $friend }}
		@endwhile
	@endif

	<br>
	<br>

	@for ($i = 0; $i < 10; $i++)
		Current value of i is {{ $i }}
		<br>
	@endfor
</body>
</html>