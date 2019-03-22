@extends('layouts.app')

@section('content')
    <h1>Dodaj nową podkategorię</h1>
    <hr>
    {!! Form::open(['action' => 'SubcategoriesController@store', 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('name','Nazwa podkategorii')}}
            {{Form::text('name','', ['class' => 'form-control', 'placeholder' => 'Nazwa'])}}
        </div>
        <div class="form-group">
            {{Form::label('description','Angielski odpowiednik nazwy')}}
            {{Form::text('description','', ['class' => 'form-control', 'placeholder' => 'Angielska nazwa'])}}
            {{Form::hidden('category_id',$id)}}
        </div>
        <button type="submit" class="btn btn-primary" value="Dodaj"><i class="fa fa-plus" aria-hidden="true"></i> Dodaj</button>
        <a class="btn btn-danger float-right" href="/category/{{$id}}" role="button"><i class="fa fa-reply" aria-hidden="true"></i> Anuluj</a>
    {!! Form::close() !!}
@endsection
