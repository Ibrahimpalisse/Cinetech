<?php
namespace App\Controllers;

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
    
    
    public function index() {
        $movies = $this->getPopularMovies();
        $tvs = $this->getPopularTVShows();
        $view = new View();
        $view->render('home', [
            'movies' => $movies,
            'tvs' => $tvs
        ]);
        
        
    }

   
}