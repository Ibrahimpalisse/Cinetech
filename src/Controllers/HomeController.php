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
        // Gérer l'ajout aux favoris
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['favoris'])) {
            $favoris = new FavorisControleur();
            $favoris->favoris();
        }
        
        // Charger les films et séries populaires
        $movies = $this->getPopularMovies();
        $tvs = $this->getPopularTVShows();
        $genres = $this->getGenres();
        
        // Ajouter les genres et types aux films
        foreach ($movies as &$movie) {
            $movie['genres'] = array_map(function($id) use ($genres) {
                return $genres[$id] ?? '';
            }, $movie['genre_ids'] ?? []);
            $movie['type'] = 'movie'; // Ajoute le type
        }

        // Ajouter les genres et types aux séries
        foreach ($tvs as &$tv) {
            $tv['genres'] = array_map(function($id) use ($genres) {
                return $genres[$id] ?? '';
            }, $tv['genre_ids'] ?? []);
            $tv['type'] = 'tv'; // Ajoute le type
        }
        
        // Rendre la vue
        $view = new View();
        $view->render('home', [
            'movies' => $movies,
            'tvs' => $tvs
        ]);
    }
}
