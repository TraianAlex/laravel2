@extends('layouts.main')
@section('content')
<style type="text/css">
	body {text-align: center;background-color: #ccc;}
	form {display: inline;}
</style>
	{!! Form::open(array('url' => 'add')) !!}
		{!! Form::label('name', 'Project Name') !!}
		{!! Form::text('name') !!}
		{!! Form::submit('Add!') !!}
	{!! Form::close() !!}

	@foreach($projects as $project)
		<div>
			{{ $project->name }} ( {{ $project->money }} $ )
			-
			{!! Form::open(array('url' => 'donate')) !!}
				{!! Form::hidden('id', $project->id) !!}
				{!! Form::selectRange('donation', 1, 15) !!}
				{!! Form::submit('Donate!') !!}
			{!! Form::close() !!}
		</div>
	@endforeach
@endsection