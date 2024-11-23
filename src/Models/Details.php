<?php
namespace App\Models;
require_once __DIR__ . '/../../config/key_api.php';

class Details
{
    private $api_key;
    private $bas_url;

    public function __construct() {
        $this->api_key = API_KEY;
        $this->bas_url = BASE_URL;
    }

    private function fetchApiData($url) {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($curl);
        if (curl_errno($curl)) {
            curl_close($curl);
            return null; // Gérer les erreurs cURL
        }
        curl_close($curl);
        return json_decode($response, true);
    }

    public function getDetailsMovies($id) {
        $details = $this->fetchApiData($this->bas_url . "/movie/{$id}?api_key={$this->api_key}&language=fr-FR");
        $credits = $this->fetchApiData($this->bas_url . "/movie/{$id}/credits?api_key={$this->api_key}&language=fr-FR");
        $videos = $this->fetchApiData($this->bas_url . "/movie/{$id}/videos?api_key={$this->api_key}&language=fr-FR");

        $actors = $credits['cast'] ?? [];
        $actors = array_slice($actors, 0, 5);

        return [
            'details' => $details,
            'actors' => $actors,
            'videos' => $videos['results'] ?? [],
            'type' => 'movie'
        ];
    }

    public function getDetailsTvs($id) {
        $details = $this->fetchApiData($this->bas_url . "/tv/{$id}?api_key={$this->api_key}&language=fr-FR");
        $credits = $this->fetchApiData($this->bas_url . "/tv/{$id}/credits?api_key={$this->api_key}&language=fr-FR");
        $videos = $this->fetchApiData($this->bas_url . "/tv/{$id}/videos?api_key={$this->api_key}&language=fr-FR");

        $actors = $credits['cast'] ?? [];
        $actors = array_slice($actors, 0, 5);

        return [
            'details' => $details,
            'actors' => $actors,
            'videos' => $videos['results'] ?? [],
            'type' => 'tv'
        ];
    }
}
?>