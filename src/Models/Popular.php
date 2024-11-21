<?php 

namespace App\Models;
require_once __DIR__ . '/../../config/key_api.php';
class Popular
{
   
    private $api_key = API_KEY;
    private $bas_url = BASE_URL;

    public function __construct(){
        $this->api_key;
        $this->bas_url; 
    }

    function getPopularMovies() {
        $url = $this->bas_url . "/movie/popular?api_key=" . $this->api_key . "&language=fr-FR";
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response, true);
    }

    function getPopularSeries() {
        $url =  $this->bas_url . "/tv/popular?api_key=" . $this->api_key . "&language=fr-FR";
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response, true);
    }
    function getMovieGenres() {
        $url = $this->bas_url . "/genre/movie/list?api_key=" . $this->api_key . "&language=fr-FR";
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response, true);
    }
    function getTVGenres() {
        $url = $this->bas_url . "/genre/tv/list?api_key=" . $this->api_key . "&language=fr-FR";
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response, true);
    }
}
?>