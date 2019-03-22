@extends('layouts.app')

@section('content')
    <h1>Edycja użytkownika</h1>
    <h3>{{$user->name}}</h3>
    <hr>
    {!! Form::open(['action' => ['AdminPanelsController@update', $user->id], 'method' => 'POST']) !!}
        <div class="row">
            <div class="col-3">
                {{Form::label('name','Nazwa użytkownika')}}
            </div>
            <div class="col-3">
                {{Form::label('email','E-mail')}}
            </div>
            <div class="col-3">
                {{Form::label('type','Typ konta')}}
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                {{Form::text('name',$user->name, ['class' => 'form-control', 'placeholder' => 'Nazwa'])}}
            </div>
            <div class="col-3">
                {{Form::text('email',$user->email, ['class' => 'form-control', 'placeholder' => 'E-mail'])}}
            </div>
            <div class="col-3">
                {{Form::select('type', array(1 => 'Użytkownik', 2 => 'Redaktor', 3 => 'Superredaktor'), $user->role_id, ['class' => 'form-control'])}}
            </div>            
        </div>
        <br/>
        {!! Form::hidden('_method','PUT') !!}
        {{Form::submit('Zapisz', ['class' => 'btn btn-primary'])}}
        <a class="btn btn-danger float-right" href="/adminpanel" role="button">Anuluj</a>
    {!! Form::close() !!}
@endsection
