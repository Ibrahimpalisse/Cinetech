<?php 
namespace App\Models;
require_once __DIR__ . '/../../config/key_api.php';

class Details
{
    private $api_key = API_KEY;
    private $bas_url = BASE_URL;

    public function __construct(){
        $this->api_key;
        $this->bas_url; 
    }

    public function getDetailsMovies($id) {
        // Récupération des détails du film
        $url = $this->bas_url . "/movie/{$id}?api_key=" . $this->api_key . "&language=fr-FR";
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($curl);
        curl_close($curl);
    
        $details = json_decode($response, true);
    
        // Récupération des crédits (acteurs)
        $credits_url = $this->bas_url . "/movie/{$id}/credits?api_key=" . $this->api_key . "&language=fr-FR";
        $curl = curl_init($credits_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $credits_response = curl_exec($curl);
        curl_close($curl);
    
        $credits = json_decode($credits_response, true);
        $actors = $credits['cast'] ?? [];
        $actors = array_slice($actors, 0, 5); // Limite à 5 acteurs principaux
    
        // Récupération des vidéos
        $videos_url = $this->bas_url . "/movie/{$id}/videos?api_key=" . $this->api_key . "&language=fr-FR";
        $curl = curl_init($videos_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $videos_response = curl_exec($curl);
        curl_close($curl);
    
        $videos = json_decode($videos_response, true);
    
        // Retourne les détails du film avec les acteurs et vidéos
        return [
            'details' => $details,
            'actors' => $actors,
            'videos' => $videos['results'] ?? []
        ];
    }

    public function getDetailsTvs($id)
    {
        // Récupération des détails de la série
        $url = $this->bas_url . "/tv/{$id}?api_key=" . $this->api_key . "&language=fr-FR";
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($curl);
        curl_close($curl);
    
        $details = json_decode($response, true);
    
        // Récupération des crédits (acteurs)
        $credits_url = $this->bas_url . "/tv/{$id}/credits?api_key=" . $this->api_key . "&language=fr-FR";
        $curl = curl_init($credits_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $credits_response = curl_exec($curl);
        curl_close($curl);
    
        $credits = json_decode($credits_response, true);
        $actors = $credits['cast'] ?? [];
        $actors = array_slice($actors, 0, 5); // Limite à 5 acteurs principaux
    
        // Récupération des vidéos
        $videos_url = $this->bas_url . "/tv/{$id}/videos?api_key=" . $this->api_key . "&language=fr-FR";
        $curl = curl_init($videos_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $videos_response = curl_exec($curl);
        curl_close($curl);
    
        $videos = json_decode($videos_response, true);
    
        // Retourne les détails de la série avec les acteurs et vidéos
        return [
            'details' => $details,
            'actors' => $actors,
            'videos' => $videos['results'] ?? []
        ];
    }
    
    
    
}
?>