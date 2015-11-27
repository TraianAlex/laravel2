@extends('layouts.main')
@section('content')
    <div class="content">
        rest controller (portfolio)
        {!! Form::open(array('url' => 'portfolio/process')) !!}
            {!! Form::submit() !!}
        {!! Form::close() !!} 

        resource controller (recipes)
        {!! Form::open(array('url' => 'recipes/spaghetti', 'method' => 'PUT')) !!}
            {!! Form::submit() !!}
        {!! Form::close() !!} 
    </div>
@endsection