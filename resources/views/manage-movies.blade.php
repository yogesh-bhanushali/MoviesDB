@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-12">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Movie</th>
                    <th>Director</th>
                    <th>Genre</th>
                    <th>Popularity</th>
                    <th>IMDB Score</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($movies as $movie)
                <tr>
                    <td>{{ $movie['name'] }}</td>
                    <td>{{ $movie['director']}} </td>
                    <td>{{ implode(', ', $movie['genre'])}} </td>
                    <td>{{ $movie['99popularity']}}</td>
                    <td>{{ $movie['imdb_score']}}</td>
                    <td>
                        <button type="button" class="btn" data-movie-id="{{$movie['_id']}}" onclick="deleteMovie(this);">
                        <span>x</span>
                        </button>
                    </td>
                </tr>
            @endforeach        
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
    
    function deleteMovie(element) {

        var movie   = $(element).data("movie-id");
        var data = JSON.stringify({
            'movie' : movie,
        });

        if(!confirm("Are you sure you want to delete this movie?"))
            return false;

        $.ajax({
            data    : data,
            url: '{{route("movies.delete")}}',
            method  : 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-Token': '{{ csrf_token() }}'
            },
            success : function(response) {
                if (response.status_code == 200) {
                    alert("Movie deleted.");
                    //Reload page
                    window.location.reload();
                }
                else {
                    alert("Error Deleting Movie.");
                }
            }
        });
    }

</script>
@endsection