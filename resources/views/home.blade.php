@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Twoje zestawy</div>

                <div class="card-body">
                    @if(count($sets) > 0)
                    <table class="table table-striped table-bordered table-hover table-sm">
                        <thead class="thead-dark">
                            <tr>
                                <th style="width: 65%">Nazwa zestawu</th>
                                <th style="width: 35%; text-align:right">Typ</th>
                            </tr>
                        </thead>
                        @foreach($sets as $set)
                        <tr>
                            <td>
                            @if($set->hidden != 1)
                                <a href="/set/{{$set->id}}">{{$set->name}}</a>
                            @else
                                {{$set->name}}
                            @endif
                            </td>
                            @if($set->hidden == 0)
                            <td style="text-align:right">Ogólny</td>
                            @elseif($set->hidden == 2)
                            <td style="text-align:right">Prywatny</td>
                            @else
                            <td style="text-align:right">Ukryty przez administratora</td>
                            @endif
                        </tr>
                        @endforeach
                    </table>
                    @else
                        <p>Brak dodanych zestawów</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
