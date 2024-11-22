<?php
namespace App\Controllers;
session_start();

use App\Views\View;
use App\Models\Popular; 

class HomeController {  
    public function getPopularMovies() {
        $api = new Popular();
        $movies = $api->getPopularMovies();
        return $movies['results'] ?? [];
    }
    
    public function getPopularTVShows() {
        $api = new Popular();
        $tvs = $api->getPopularSeries();
        return $tvs['results'] ?? [];
    }

    public function getGenres() {
        $api = new Popular();
        $genres = $api->getMovieGenres();
        $genresList = $genres['genres'] ?? [];
        
        // Convert list to a key-value map for easier access
        $mappedGenres = [];
        foreach ($genresList as $genre) {
            $mappedGenres[$genre['id']] = $genre['name'];
        }
        return $mappedGenres;
    }
    
    public function index() {
        $movies = $this->getPopularMovies();
        $tvs = $this->getPopularTVShows();
        $genres = $this->getGenres();
        
        // Add genre names to movies
        foreach ($movies as &$movie) {
            $movie['genres'] = array_map(function($id) use ($genres) {
                return $genres[$id] ?? '';
            }, $movie['genre_ids'] ?? []);
        }

        // Add genre names to TV shows
        foreach ($tvs as &$tv) {
            $tv['genres'] = array_map(function($id) use ($genres) {
                return $genres[$id] ?? '';
            }, $tv['genre_ids'] ?? []);
        }
        
        $view = new View();
        $view->render('home', [
            'movies' => $movies,
            'tvs' => $tvs
        ]);
    }
}
