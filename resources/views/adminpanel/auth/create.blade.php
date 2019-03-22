@extends('layouts.app')
@section('content')
    @if(count($subcategories) > 0)
    {!! Form::open(['action' => 'AuthorizationsController@store', 'method' => 'POST']) !!}
    <div class="card">
        <div class="card-header">
            <h3>Dodawanie uprawnień</h3>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered table-hover table-sm">
                <thead class="thead-dark">
                    <tr>
                        <th>Nazwa kategorii</th>
                        <th>Nazwa podkategorii</th>
                        <th></th>
                    </tr>
                </thead>
                @foreach($subcategories as $subcategory)
                    <tr>
                        <td>{{$subcategory->category->name}}</td>
                        <td>{{$subcategory->name}}</td>
                        <td>{{ Form::checkbox('name[]', $subcategory->id) }}</td>
                    </tr>
                @endforeach
            </table>
            {{ Form::hidden('user_id', $user_id) }}
            <button type="submit" class="btn btn-primary" value="Dodaj"><i class="fa fa-plus" aria-hidden="true"></i> Dodaj</button>
            <a class="btn btn-danger float-right" href="/auth/{{$user_id}}" role="button"><i class="fa fa-reply" aria-hidden="true"></i> Anuluj</a>
            {!! Form::close() !!}
        </div>
    </div>
    @endif
@endsection