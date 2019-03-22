@extends('layouts.app')

@section('content')
<?php $percentage = round(($result/$NoW*100), 2); ?>
<div class="row">
    <div class="col-4">
        <a class="btn btn-danger float-left" href="/set/{{$set->id}}" role="button"><i class="fa fa-reply" aria-hidden="true"></i> Powrót</a>
    </div>
</div>
<br/>
<div class="card">
    <div class="card-header">
        <h3>Wyniki nauki zestawu {{$set->name}}</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-4">Nauczone:</div>
            <div class="col-4">{{$result}}/{{$NoW}}</div>
        </div>
        <div class="row">
            <div class="col-4">Wynik procentowy:</div>
            <div class="col-4">{{$percentage}}%</div>
        </div>
        @if(!Auth::guest() && $isTest == 1)
            <br/>
            {!! Form::open(['action' => 'ResultsController@store', 'method' => 'POST']) !!}
            {{Form::hidden('set_id',$set->id)}}
            {{Form::hidden('percentage',$percentage)}}
            <div class="row">
                <div class="col-4">
                    <button type="submit" class="btn btn-success" value="Zapisz wynik"><i class="fa fa-floppy-o" aria-hidden="true"></i> Zapisz wynik</button>
                </div>
            </div>
            {!! Form::close() !!}
        @endif
    </div>
</div>
@endsection