@extends('layouts.app')

@section('content')
    <h1>Plaats een bericht</h1>
    {!! Form::open(['action' => 'PostsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('title', 'Titel')}}
            {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Titel'])}}
        </div>
        <div class="form-group">
            {{Form::label('body', 'Bericht')}}
            {{Form::textarea('body', '', ['id' => 'tinymce', 'class' => 'form-control', 'placeholder' => 'Uw Bericht..'])}}
        </div>
        <div class="form-group">
            {{Form::file('cover_image')}}
        </div>
        {{Form::submit('Plaats', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection