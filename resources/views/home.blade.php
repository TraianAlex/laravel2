@extends('layouts.main')
@section('content')
	<div class="row">
		@if(Auth::check())
			<p>Hello, {{ Auth::user()->username }}</p>
		@else
			<p>You are not signed in.</p>
		@endif
	</div>
@endsection