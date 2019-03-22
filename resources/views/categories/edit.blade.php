@extends('layouts.app')

@section('content')
    <h1>Edycja kategorii</h1>
    <hr>
    {!! Form::open(['action' => ['CategoriesController@update', $category->id], 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('name','Nazwa kategorii')}}
            {{Form::text('name',$category->name, ['class' => 'form-control', 'placeholder' => 'Nazwa'])}}
        </div>
        <div class="form-group">
            {{Form::label('description','Krótki opis')}}
            {{Form::text('description',$category->description, ['class' => 'form-control', 'placeholder' => 'Opis'])}}
        </div>
        {!! Form::hidden('_method','PUT') !!}
        {{Form::submit('Zapisz', ['class' => 'btn btn-primary'])}}
        <a class="btn btn-danger float-right" href="/category" role="button">Anuluj</a>
    {!! Form::close() !!}
    
@endsection
