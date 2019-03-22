@extends('layouts.app')

@section('style')
<link href="{{ asset('css/flashcard.css') }}" rel="stylesheet">
@endsection

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
        <h1>Fiszki: {{ $set->name }}</h1>
        <hr>
        <div class="card">
            {!! Form::open(['action' => 'LearnController@result', 'method' => 'POST', 'name' => 'form']) !!}
            <div class="card-body">
                @for($i = 0; $i<count($array); $i++)
                    <div id="container{{$i}}">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width:{{($i/count($array))*100}}%"></div>
                        </div>
                        <br/>
                        <section class="flashcontainer">
                            <div class="flashcard" onclick="flip()">
                                <div class="flashfront">{{key(array_slice($array,$i,1))}}</div>
                                <div class="flashback">{{$array[key(array_slice($array,$i,1))]}}</div>
                            </div>
                        </section>
                        <br/>
                        <div class="text-center">
                            <button class="btn btn-success" onclick="nextWord({{$i}}, 1)"><i class="fa fa-thumbs-up" aria-hidden="true"></i> Znam</button>
                            <button class="btn btn-danger" onclick="nextWord({{$i}}, 0)"><i class="fa fa-thumbs-down" aria-hidden="true"></i> Nie znam</button>
                        </div>
                    </div>
                @endfor
            </div>
            {{Form::hidden('result','',['id' => 'result'])}}
            {{Form::hidden('set_id',$set->id)}}
            {{Form::hidden('isTest',$test)}}
            {{Form::hidden('NoW',count($array))}}
            {!! Form::close() !!}
        </div>
    @else
        <h1>Zestaw nie istnieje!</h1>
    @endif
@include('inc.scripts.flashcardscript')
@endsection