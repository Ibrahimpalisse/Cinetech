<?php

namespace App\Controllers;

use App\Models\Search;

class SearchController {
    public function handleSearch() {
        header('Content-Type: application/json');

        if (isset($_GET['q']) && !empty($_GET['q'])) {
            $query = htmlspecialchars($_GET['q']);
            $search = new Search();
            $results = $search->searchItems($query);

            echo json_encode($results, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            exit;
        } else {
            echo json_encode(['error' => 'Termes de recherche manquants.']);
            exit;
        }
    }
}
