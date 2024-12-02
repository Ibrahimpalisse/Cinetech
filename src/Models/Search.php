<?php

namespace App\Models;
require_once __DIR__ . '/../../config/key_api.php';
namespace App\Models;

class Search {

    private $api_key = API_KEY;
    private $base_url = BASE_URL;
    public function __construct() {

        $this->api_key = API_KEY;
        $this->base_url = BASE_URL;
    }

    public function searchItems($query) {
        // Construire l'URL de recherche
        $url = $this->base_url . "/search/multi?api_key=" . $this->api_key . "&query=" . urlencode($query);

        try {
            // Initialisation de la requête cURL
            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => [
                    "Content-Type: application/json"
                ],
            ]);

            // Exécution de la requête
            $response = curl_exec($curl);
            $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);
           
            // Vérification des erreurs ou de la réponse
            if ($response === false || $http_code !== 200) {
                throw new \Exception("Erreur lors de l'appel à l'API. Code HTTP : " . $http_code);
            }

            // Décoder la réponse JSON
            $data = json_decode($response, true);

            // Retourner les résultats s'ils existent
            return $data['results'] ?? [];
        } catch (\Exception $e) {
            // En cas d'erreur, retourner un tableau avec un message d'erreur
            return [
                'error' => $e->getMessage()
            ];
        }
    }
}
   