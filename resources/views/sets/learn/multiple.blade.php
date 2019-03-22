@extends('layouts.app')

@section('content')
    @if(!is_null($set))
        <?php
            function shuffle_assoc(&$array) {
                $keys = array_keys($array);
                shuffle($keys);
                foreach($keys as $key) {
                    $new[$key] = $array[$key];
                }
                $array = $new;
                return true;
            }
            $split = explode(';', $set->set);
            $array = array();
            for($i = 0; $i < count($split); $i+=2){
                if($lang == 2){
                    $array[$split[$i+1]] = $split[$i];
                }
                if($lang == 1){
                    $array[$split[$i]] = $split[$i+1];
                }
            }
            shuffle_assoc($array);
            if($lang == 1){
                $lang1 = 'Polski';
                $lang2 = 'Angielski';
            }
            else{
                $lang1 = 'Angielski';
                $lang2 = 'Polski';
            }
        ?>
        <h1>Odpytywanie: {{ $set->name }}</h1>
        <hr>
        <div class="card">
            {!! Form::open(['action' => 'LearnController@result', 'method' => 'POST', 'name' => 'form']) !!}
            <div class="card-body">
                <div class="progress">
                    <div id="bar" class="progress-bar" role="progressbar" style="width:0%"></div>
                </div>
                <br/>
                @for($i = 0; $i<count($array); $i++)
                    <div id="container{{$i}}">
                        <div class="row">
                            <div class="col-3">
                            {{Form::label('lang1',$lang1)}}
                            </div>
                            <div class="col-4">
                            {{Form::label('word1',key(array_slice($array,$i,1)), ['id' => 'w1id'.$i])}}
                            {{Form::hidden('check',$array[key(array_slice($array,$i,1))], ['id' => 'checkid'.$i])}}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-3">
                            {{Form::label('lang2',$lang2)}}
                            </div>
                            <div class="col-4">
                            {{Form::text('word2','', ['class' => 'form-control', 'id' => 'w2id'.$i, 'onkeydown' => 'if (event.keyCode == 13) { return false; }'])}}
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-4">
                                <button class="btn btn-primary" onclick="nextWord({{$i}})">Następne słowo</button>
                                <button class="btn btn-success" onclick="checkWord({{$i}})">Sprawdź</button>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
            {{Form::hidden('result','',['id' => 'result'])}}
            {{Form::hidden('set_id',$set->id)}}
            {{Form::hidden('NoW',count($array))}}
            {!! Form::close() !!}
        </div>
    @else
        <h1>Zestaw nie istnieje!</h1>
    @endif
@include('inc.scripts.multiplescript')
@endsection