<?php

namespace App\Models;
require_once __DIR__ . '/../../config/key_api.php';
namespace App\Models;

class Tv {
    private $api_key = API_KEY;
    private $base_url = BASE_URL;

    public function getGenres() {
        $url = $this->base_url . "/genre/tv/list?api_key=" . $this->api_key . "&language=fr-FR";
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($curl);
        curl_close($curl);

        $genres = json_decode($response, true);

        if (!$genres || isset($genres['status_code'])) {
            throw new \Exception("Erreur lors de la récupération des genres des séries.");
        }

        return $genres['genres']; // Retourne un tableau avec les genres des séries
    }

    public function getSeriesByGenre($genreId, $page = 1) {
        $url = $this->base_url . "/discover/tv?api_key=" . $this->api_key . "&language=fr-FR&sort_by=popularity.desc&with_genres=" . $genreId . "&page=" . $page;
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($curl);
        curl_close($curl);

        $series = json_decode($response, true);

        if (!$series || isset($series['status_code'])) {
            throw new \Exception("Erreur lors de la récupération des séries.");
        }

        return [
            'results' => $series['results'],
            'total_pages' => $series['total_pages'],
            'current_page' => $series['page']
        ];
    }
}
