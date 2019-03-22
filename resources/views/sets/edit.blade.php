@extends('layouts.app')

@include('inc.dynamicform')

@section('content')
    <h1>Edytuj zestaw</h1>
    <hr>
    <?php $split = explode(';', $set->set); ?>
    {!! Form::open(['action' => ['SetsController@update', $set->id], 'method' => 'POST']) !!}
    <div id="container">
        <div class="row">
            <div class="col-3">
            {{Form::label('name','Nazwa zestawu')}}
            </div>
            <div class="col-4">
            {{Form::label('lang','Metoda wprowadzania')}}
            </div>
        </div>
        <div class="row">
            <div class="col-3">
            {{Form::text('name',$set->name, ['class' => 'form-control', 'placeholder' => 'Nazwa'])}}
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
            {{Form::text('word1[]',$split[0], ['class' => 'form-control', 'placeholder' => 'Słówko 1'])}}
            </div>
            <div class="col-4">
            {{Form::text('word2[]',$split[1], ['class' => 'form-control', 'placeholder' => 'Słówko 2'])}}
            </div>
            <div class="col-4">
            <a class="float-right" href="#" id="add"><i class="fa fa-plus fa-2x" aria-hidden="true" style="color:green"></i></a>
            </div>
        </div>
    </div>
    <br/>
    {!! Form::hidden('_method','PUT') !!}
    {{Form::submit('Zapisz', ['class' => 'btn btn-primary'])}}
    <a class="btn btn-danger float-right" href="/subcategory/{{$set->subcategory_id}}" role="button">Anuluj</a>
    {!! Form::close() !!}

    <a class="btn btn-danger" href="#" role="button" id="add2" style="display: none;"></a>

    @for($j = 2; $j<count($split); $j+=2)
        <script>
            $(document).ready(function(){
                $('#add2').trigger("click", ["<?php echo $split[$j]; ?>", "<?php echo $split[$j+1]; ?>"]);
            });
        </script>
    @endfor
@endsection