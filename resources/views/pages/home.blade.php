<style type="text/css">.message {font-weight: bold;color: red;}</style>
@extends('layouts.master')

@section('navigation-bar')
	@parent
	<a href="about">About</a>
	<a href="contact">Contact</a>
@stop

@section('content')
	{!! Html::ul($list) !!}
	Welcome to the homepage of our application. Everything is still working!<br>
	Conected with database {{ $name }}

	<form action='verify' method='POST'>
		 <input type="hidden" name="_token" value="{{csrf_token() }}">
		<label>
			Username:
			<input name='username' type='text'>
		</label>
		<br>
		<label>
			Password:
			<input name='password' type='password'>
		</label>
		<br>
		<input type='submit'>
	</form>
	<br>

	{!! Form::open(array('url' => '/verify', 'method' => 'POST')) !!}
		{!! Form::text('username', 'Username here...') !!}
		{!! Form::select('flavor', $flavors) !!}
		{!! Form::submit('Submit Me!') !!}
	{!! Form::close() !!}
	<br>

	@foreach($errors->all("<p class='message'>:message</p>") as $error)
		{!! $error !!}
	@endforeach
	{!! Form::open(array('url' => '/validation')) !!}
		<p>
			{!! Form::label('name') !!}
			{!! Form::text('name') !!}
		</p>
		<p>
			{!! Form::label('link') !!}
			{!! Form::text('link') !!}
		</p>
		<p>
			{!! Form::label('password') !!}
			{!! Form::password('password') !!}
		</p>
		<p>
			{!! Form::label('password-repeat') !!}
			{!! Form::password('password-repeat') !!}
		</p>
		<p>
			{!! Form::submit() !!}
		</p>
	{!! Form::close() !!}
@stop