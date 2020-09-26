@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">Filters</div>
                <div class="panel-body">
                    <h4>Genre</h4>
                    <hr/>
                    <ul style="list-style-type: none; padding-left: 0;">
                        @foreach($genre as $gen)
                            <li style="display: inline-block;">
                                <input type="checkbox" class="genreFilter" value="{{$gen}}" name="genre" id="{{$gen}}"/>
                                <label for="{{$gen}}">{{$gen}}</label>
                            </li>
                        @endforeach 
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9 movieList">
            <div class="panel panel-default">
                <div class="panel-heading">Movies
                    <div class="sortFilters" style="width: 25%; display: inline-block; float: right;">
                        <select class="form-control" id="sortFilter">
                            <option value="">Sort by</option>
                            <option value="99popularity_asc">Popularity Low to High</option>
                            <option value="99popularity_desc">Popularity High to Low</option>
                            <option value="director_asc">Director - A-Z</option>
                            <option value="director_desc">Director - Z-A</option>
                            <option value="name_asc">Movie - A-Z</option>
                            <option value="name_desc">Movie - Z-A</option>
                        </select>
                    </div>
                    <span class="clearfix"></span>
                </div>
                <div class=searchBox>
                    <input type="text" id="search_keyword" placeholder="search movie name or director name">
                </div>
                <p align="center">Found <span id="moviesCount" style="font-weight: bold;">{{count($movies)}}</span> movies</p>
                <div class="panel-body movieComponent">
                    @foreach($movies as $movie)
                        <div class="col-md-6">
                            <div class="movie">
                                <h2>{{ $movie['name'] }} </h2>
                                <hr/>
                                <p>{{ $movie['director']}} </p>
                                <p>{{ implode(', ', $movie['genre'])}} </p>
                                <p class="inlineBlock" style="margin-right: 2em"><label>Popularity: </label>{{ $movie['99popularity']}} </p>
                                <p class="inlineBlock"><label>Score: </label>{{ $movie['imdb_score']}} </p>
                            </div>
                        </div>
                    @endforeach 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
