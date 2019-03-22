@extends('layouts.app')

@section('content')
<?php
    $res = '[';
    for($i=0; $i<count($results); $i++){
        if($i==count($results)-1) $res = $res.(round($results[$i]->result)).']';
        else $res = $res.($results[$i]->result).', ';
    }
?>
<a class="btn btn-danger" href="/results/" role="button"><i class="fa fa-reply" aria-hidden="true"></i> Powrót</a>
<div class="container">
    <br/>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header" style="text-align:center">
                        <h3>{{$results[0]->set->name}}</h3>
                    </div>
                    <div class="card-block">
                        <div id="chart1"></div>
                        <br/>
                        <h5>*Słupki od najnowszego podejścia do najstarszego</h5>
                    </div>
                </div>
            </div>
        </div>   
    </div>
@include('inc.scripts.barscript')
@endsection