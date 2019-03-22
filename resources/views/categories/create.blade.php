@extends('layouts.app')

@section('content')
    <h1>Dodaj nową kategorię</h1>
    <hr>
    {!! Form::open(['action' => 'CategoriesController@store', 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('name','Nazwa kategorii')}}
            {{Form::text('name','', ['class' => 'form-control', 'placeholder' => 'Nazwa'])}}
        </div>
        <div class="form-group">
            {{Form::label('description','Angielski odpowiednik nazwy')}}
            {{Form::text('description','', ['class' => 'form-control', 'placeholder' => 'Angielska nazwa'])}}
        </div>
        <button type="submit" class="btn btn-primary" value="Dodaj"><i class="fa fa-plus" aria-hidden="true"></i> Dodaj</button>
        <a class="btn btn-danger float-right" href="/category" role="button"><i class="fa fa-reply" aria-hidden="true"></i> Anuluj</a>
    {!! Form::close() !!}
@endsection
