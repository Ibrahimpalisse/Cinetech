<?php

namespace App\Models;


require_once __DIR__ . '/../../config/key_api.php';

class FavoriRecupe
{
    private $api_key = API_KEY;
    private $base_url = BASE_URL;


    public function getFavorisFromDB($userId)
    {
        $favorisModel = new Favoris(); // Modèle pour récupérer les favoris
        return $favorisModel->getFavoris($userId);
    }

  
    public function getDetailsFromTMDB($mediaType, $mediaId, $addedAt)
    {
        $url = $this->base_url . "/{$mediaType}/{$mediaId}?api_key={$this->api_key}&language=fr-FR";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($curl);
        curl_close($curl);

        $details = json_decode($response, true);

        if (empty($details)) {
            return [
                'error' => "Impossible de récupérer les détails pour {$mediaType} avec ID {$mediaId}."
            ];
        }
        return [
            'type' => $mediaType,
            'id' => $details['id'],
            'title' => $details['title'] ?? $details['name'] ?? 'Titre inconnu',
            'genre' => $this->getGenres($details['genres']),
            'image' => "https://image.tmdb.org/t/p/w500" . ($details['poster_path'] ?? ''),
            'type' => $mediaType,
            'added_at' =>  $addedAt, // Inclure la date d'ajout
            
        ];
        
    }

  
     // Convertit une liste de genres en une chaîne lisible.
   
    private function getGenres($genres)
    {
        if (is_array($genres)) {
            return implode(', ', array_column($genres, 'name'));
        }
        return 'Genres inconnus';
    }
}
