@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-4">
            <a class="btn btn-danger float-left" href="/subcategory/{{$set->subcategory->id}}" role="button"><i class="fa fa-reply" aria-hidden="true"></i> Powrót</a>
        </div>
    </div>
    <br/>
    @if(!is_null($set))
        <h1>{{$set->subcategory->name}}</h1>
        <hr>
        <?php $split = explode(';', $set->set); ?>
        <div class="card">
            <div class="card-header"><h3>{{$set->name}}</h3></div>
            <div class="card-body">
                <table class="table table-striped table-bordered table-hover table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th style="width: 50%">Angielski</th>
                            <th style="width: 50%">Polski</th>
                        </tr>
                    </thead>
                    @for($i = 0; $i<count($split); $i+=2)
                        @if($i%2 == 0)
                            <tr>
                                <td>{{$split[$i+1]}}</td>
                                <td>{{$split[$i]}}</td>
                        @else
                                <td>{{$split[$i]}}</td>
                            </tr>
                        @endif
                    @endfor
                </table>
                <small>Autor: {{$set->user->name}}</small>
                @if(!is_null($set->created_at))
                    <p><small>Data dodania: {{$set->created_at}}</small></p>
                @endif
                <hr>
                {!!Form::open(array('url' => '/set/learn')) !!}
                    {!! Form::hidden('current_id', $set->id) !!}
                <div class="row">
                    <div class="col-12">
                        <div class="text-center">
                            <h3>Tryby nauki i sprawdzania wiedzy</h3>
                        </div>
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-2">
                        {{ Form::label('choose','Wybierz sposób wprowadzania:') }}
                    </div>
                    <div class="col-2">
                        {{ Form::select('lang', array(1 => 'Pol - Ang', 2 => 'Ang - Pol'), null, ['class' => 'form-control']) }}
                    </div>
                    <div class="col-8">
                        <button type="submit" class="btn btn-primary" name="learn1" value="Odpytywanie (jedna próba)"><i class="fa fa-angle-right" aria-hidden="true"></i> Odpytywanie (jedna próba)</button>
                        <button type="submit" class="btn btn-primary" name="learnm" value="Odpytywanie (wiele prób)"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Odpytywanie (wiele prób)</button>
                        <button type="submit" class="btn btn-primary" name="flashcards" value="Fiszki"><i class="fa fa-square-o" aria-hidden="true"></i> Fiszki</button>
                        <button type="submit" class="btn btn-danger" name="test" value="Sprawdź wiedzę"><i class="fa fa-tablet" aria-hidden="true"></i> Sprawdź wiedzę</button>
                    </div>
                </div>
                {!! Form::close() !!}
                <br/>
            </div>
        </div>
    @else
    <h3>Zestaw nie istnieje</h3>
    @endif

@endsection
