<?php

namespace App\Http\Controllers;
use Auth;

use Illuminate\Http\Request;
use Response;
use DB;
use Session;

class HomeController extends Controller {

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        $movies = \DB::connection('mongodb')
                    ->collection('movies')
                    ->project(['_id' => 0])
                    ->get();

        $genre = \DB::connection('mongodb')
                    ->collection('movies')
                    ->distinct('genre')
                    ->project(['_id' => 0])
                    ->get();

        return view('home')->with("movies", $movies)->with("genre", $genre);
    }

    public function filterMoviesByGenre(Request $request){

        $movies = [];
        //Check if genre is selected
        $genreList = $request->input('GenreList');
        if (count($genreList) > 0) {
            $movies = \DB::connection('mongodb')
                     ->collection('movies')
                     ->whereIn('genre', $genreList)
                     ->project(['_id' => 0])
                     ->get();                
        }else{                
            $movies = \DB::connection('mongodb')
                ->collection('movies')
                ->project(['_id' => 0])
                ->get();
        }

        return Response::json(array('data'=> $movies,'status_code'=>200));
    }

    public function sortMovies(Request $request){

        $movies = [];
        //Check if genre is selected
        $sortValue  = $request->input("SortValue");
        $sortParams = explode('_', $sortValue);
        if (count($sortParams) > 0) {

            $movies = \DB::connection('mongodb')
                     ->collection('movies')
                     ->orderBy($sortParams[0], $sortParams[1])
                     ->project(['_id' => 0])
                     ->get();                
        }else{                
            $movies = \DB::connection('mongodb')
                ->collection('movies')
                ->project(['_id' => 0])
                ->get();
        }

        return Response::json(array('data'=> $movies,'status_code'=>200));
    }

    public function searchMovies(Request $request){

        $movies = [];
        //Check if genre is selected
        $searchKey  = $request->input("SearchKeyword");
        if (strlen($searchKey) > 0) {

            $movies = \DB::connection('mongodb')
                     ->collection('movies')
                     ->where('director', 'LIKE', '%'.$searchKey.'%')
                     ->orWhere('name', 'LIKE', '%'.$searchKey.'%')
                     ->project(['_id' => 0])
                     ->get();                
        }else{                
            $movies = \DB::connection('mongodb')
                ->collection('movies')
                ->project(['_id' => 0])
                ->get();
        }

        return Response::json(array('data'=> $movies,'status_code'=>200));
    }

    public function manageMovies(Request $request){

        if(Auth::user()) {

            $movies = [];
            $movies = \DB::connection('mongodb')
                ->collection('movies')
                ->get();

            return view('manage-movies')->with("movies", $movies);

        }else{
            return redirect("/home");
        }

    }

    public function deleteMovie(Request $request){

        if(Auth::user()) {

            $movie = $request->input("movie");
            $status = \DB::connection('mongodb')
                ->collection('movies')
                ->where("_id", $movie)
                ->delete();

            return Response::json(array('data'=> $status,'status_code'=>200));

        }else{
            return redirect("/home");
        }
    }
    
}
