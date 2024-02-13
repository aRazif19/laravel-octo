<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\Movie_Rating;
use App\Models\Movie_Showtime;
use App\Models\Movie_Genre;
use Illuminate\Http\Request;
use Nette\Utils\DateTime;

class MovieAPIController extends Controller
{

    public function movies()
    {
        $movies = Movie::all();
        return response()->json(['data' => $movies]);
    }


    public function genre(Request $request)
    {
        $movie = Movie::select(
            'movies.id as Movie_ID',
            'movies.title as Title',
            'movie_genres.genre as Genre',
            'movies.description as Description',
        )
            ->join('genre_movie', 'movies.id', '=', 'genre_movie.movie_id')
            ->join('movie_genres', 'genre_movie.genre_id', '=', 'movie_genres.id')
            ->where('movie_genres.genre', '=', $request->genre)
            ->get();

        return response()->json(['data' => $movie], 200);
    }

    public function specific_movie_theater(Request $request)
    {
        $datetimestr = $request->date;
        $datetime = new DateTime($datetimestr);
        $date = $datetime->format('Y-m-d');

        $movies = Movie::select(
            'movies.id as Movie_ID',
            'movies.title as Title',
            'movies.theater_name as Theater_name',
            'movie_showtimes.show_start as Start_time',
            'movie_showtimes.show_end as End_time',
            'movies.description as Description',
            'movie_showtimes.theater_room_no as Theater_room_no',
        )
            ->join('movie_movie_showtime', 'movies.id', '=', 'movie_movie_showtime.movie_id')
            ->join('movie_showtimes', 'movie_movie_showtime.movie_showtime_id', '=', 'movie_showtimes.id')
            ->where('movies.theater_name', $request->theater_name)
            ->whereDate('movie_showtimes.show_start', $date)
            ->get();

        return response()->json(['data' => $movies], 200);
    }

    public function timeslot(Request $request)
    {
        $movie = Movie_Showtime::select(
            'movies.id as Movie_ID',
            'movies.title as Title',
            'movies.theater_name as Theater_name',
            'movie_showtimes.show_start as Start_time',
            'movie_showtimes.show_end as End_time',
            'movies.description as Description',
            'movie_showtimes.theater_room_no as Theater_room_no',
        )
            ->join('movie_movie_showtime', 'movie_showtimes.id', '=', 'movie_movie_showtime.movie_showtime_id')
            ->join('movies', 'movie_movie_showtime.movie_id', '=', 'movies.id')
            ->where('movies.theater_name', $request->theater_name)
            ->whereBetween('movie_showtimes.show_start', [$request->show_start, $request->show_end])
            ->get();

        return response()->json(['data' => $movie], 200);
    }

    public function search_performer(Request $request)
    {
        $movie = Movie::select(
            'movies.id as Movie_ID',
            'movies.overall_rating as Overall_rating',
            'movies.title as Title',
            'movies.description as Description'
        )
            ->join('movie_movie_performer', 'movies.id', '=', 'movie_movie_performer.movie_id')
            ->join('movie_performers', 'movie_movie_performer.movie_performer_id', '=', 'movie_performers.id')
            ->where('movie_performers.performer_name', $request->performer_name)
            ->get();

        return response()->json(['data' => $movie], 200);
    }

    public function new_movies(Request $request)
    {
        $movie = Movie::select(
            'movies.id as Movie_ID',
            'movies.overall_rating as Overall_rating',
            'movies.title as Title',
            'movies.Description'
        )
            ->where('movies.release', $request->release_date)
            ->get();

        return response()->json(['data' => $movie], 200);
    }

    public function add_movie()
    {
        //
    }

    public function give_rating()
    {
        //
    }
}
