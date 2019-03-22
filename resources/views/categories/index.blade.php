@extends('layouts.app')

@section('content')
    <h1>Kategorie</h1>
    <hr>
    @if(!Auth::guest() && Auth::user()->role_id == 10)
        <a class="btn btn-primary btn-sm" href="/category/create" role="button"><i class="fa fa-plus" aria-hidden="true"></i> Dodaj kategorię</a>
        <hr>
    @endif

    @if(count($categories) > 0)
        @for($hidden = 0; $hidden < 2; $hidden++)
            @if($hidden == 1 && !Auth::guest() && Auth::user()->role_id == 10)
            <br/>
            <h1>Ukryte kategorie</h1>
            <hr>
            @endif
            @if(($hidden == 1 && !Auth::guest() && Auth::user()->role_id == 10) || ($hidden == 0))
            <?php $i = 0; ?>
            @foreach($categories as $category)
                @if($category->hidden == $hidden)
                    @if($i%3 == 0)
                        <div class="row">
                    @endif
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-header">
                                <h3><a href="/category/{{$category->id}}">{{$category->name}}</a></h3>
                            </div>
                            <div class="card-body">
                                <small>{{$category->description}}</small>
                                @if(!Auth::guest() && Auth::user()->role_id == 10)
                                    <p>
                                    {!! Form::open(['action' => ['CategoriesController@destroy', $category->id], 'method' => 'POST', 'class' => 'float-right']) !!}
                                        {{ Form::hidden('_method','DELETE') }}
                                        <button type="submit" class="btn btn-danger btn-sm" value="Usuń"><i class="fa fa-times" aria-hidden="true"></i> Usuń</button>
                                    {!! Form::close() !!}
                                    @if($hidden == 0)
                                    {!! Form::open(['action' => ['CategoriesController@hideCategory', $category->id, 'hide'], 'method' => 'POST', 'class' => 'float-right']) !!}
                                        {{ Form::hidden('_method','PUT') }}
                                        <button type="submit" class="btn btn-default btn-sm" value="Ukryj"><i class="fa fa-eye-slash" aria-hidden="true"></i> Ukryj</button>
                                    @else
                                    {!! Form::open(['action' => ['CategoriesController@hideCategory', $category->id, 'unhide'], 'method' => 'POST', 'class' => 'float-right']) !!}
                                        {{ Form::hidden('_method','PUT') }}
                                        <button type="submit" class="btn btn-default btn-sm" value="Pokaż"><i class="fa fa-eye" aria-hidden="true"></i> Pokaż</button>
                                    @endif
                                    {!! Form::close() !!}
                                    <a class="btn btn-primary btn-sm float-right" href="/category/{{$category->id}}/edit" role="button"><i class="fa fa-pencil" aria-hidden="true"></i> Edytuj</a>
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @if($i%3 == 2)
                        </div>
                    @endif
                    <?php $i++; ?>
                @endif
            @endforeach
            @if($i%3 != 0)
                </div>
            @endif
            @endif
        @endfor
    @else
        <h3>Brak kategorii</h3>
    @endif
@endsection

   