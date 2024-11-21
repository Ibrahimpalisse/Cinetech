<?php

namespace App\Models;
require_once __DIR__ . '/../../config/key_api.php';
class Movie
{
   
    private $api_key = API_KEY;
    private $bas_url = BASE_URL;

    public function __construct(){
        $this->api_key;
        $this->bas_url; 
    }
    public function getGenres() {
        $url = $this->bas_url . "/genre/movie/list?api_key=" . $this->api_key . "&language=fr-FR";
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($curl);
        curl_close($curl);
    
        $genres = json_decode($response, true);
    
        if (!$genres || isset($genres['status_code'])) {
            throw new \Exception("Erreur lors de la récupération des genres.");
        }
    
        return $genres['genres'];
    }
    
    public function getMoviesByGenre($genreId, $page = 1) {
        $url = $this->bas_url . "/discover/movie?api_key=" . $this->api_key . "&language=fr-FR&sort_by=popularity.desc&with_genres=" . $genreId . "&page=" . $page;
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($curl);
        curl_close($curl);
    
        $movies = json_decode($response, true);
    
        if (!$movies || isset($movies['status_code'])) {
            throw new \Exception("Erreur lors de la récupération des films.");
        }
    
        return [
            'results' => $movies['results'],
            'total_pages' => $movies['total_pages'],
            'current_page' => $movies['page']
        ];
    }
    
    
   
}