@extends('layouts.main')
@section('content')
	<p>{{ e($user->username) }} ({{ e($user->email) }})</p>
@endsection