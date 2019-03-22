@extends('layouts.app')

@include('inc.dynamicform')

@section('content')
    <h1>Dodaj nowy zestaw</h1>
    <hr>
    {!! Form::open(['action' => 'SetsController@store', 'method' => 'POST']) !!}
    <div id="container">
        <div class="row">
            <div class="col-3">
            {{Form::label('name','Nazwa zestawu')}}
            </div>
            <div class="col-4">
            {{Form::label('lang','Metoda wprowadzania')}}
            {{Form::hidden('subcategory_id',$id)}}
            {{Form::hidden('hidden',$hidden)}}
            </div>
        </div>
        <div class="row">
            <div class="col-3">
            {{Form::text('name','', ['class' => 'form-control', 'placeholder' => 'Nazwa'])}}
            </div>
            <div class="col-3">
            {{Form::select('lang', array(1 => 'Polski - Angielski', 2 => 'Angielski - Polski'), null, ['class' => 'form-control'])}}
            </div>
        </div>
        <div class="row">
                <div class="col-4">
                {{Form::label('word1','Słówko 1')}}
                </div>
                <div class="col-4">
                {{Form::label('word2','Słówko 2')}}
                </div>
            </div>
        <div class="row">
            <div class="col-4">
            {{Form::text('word1[]','', ['class' => 'form-control', 'placeholder' => 'Słówko 1'])}}
            </div>
            <div class="col-4">
            {{Form::text('word2[]','', ['class' => 'form-control', 'placeholder' => 'Słówko 2'])}}
            </div>
            <div class="col-4">
            <a class="float-right" href="#" id="add"><i class="fa fa-plus fa-2x" aria-hidden="true" style="color:green"></i></a>
            </div>
        </div>
    </div>
    <br/>
    <button type="submit" class="btn btn-primary" value="Dodaj"><i class="fa fa-plus" aria-hidden="true"></i> Dodaj</button>
    <a class="btn btn-danger float-right" href="/category/{{$id}}" role="button"><i class="fa fa-reply" aria-hidden="true"></i> Anuluj</a>
    {!! Form::close() !!}

@endsection