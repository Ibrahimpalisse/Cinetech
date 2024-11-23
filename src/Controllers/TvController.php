<?php

namespace App\Controllers;
session_start();

use App\Views\View;
use App\Models\Tv;

class TvController {
    public function tv() {
        try {
            $tvModel = new Tv();

            // Récupère tous les genres des séries
            $genres = $tvModel->getGenres();

            // Définit le genre par défaut sur un ID de genre spécifique (exemple : Action = 10759)
            $defaultGenreId = 10759;

            // Récupère l'ID du genre depuis l'URL ou utilise le genre par défaut
            $genreId = isset($_GET['genre']) && filter_var($_GET['genre'], FILTER_VALIDATE_INT) ? $_GET['genre'] : $defaultGenreId;

            // Récupère la page actuelle ou utilise la première page par défaut
            $page = isset($_GET['page']) && filter_var($_GET['page'], FILTER_VALIDATE_INT) ? $_GET['page'] : 1;

            // Récupère les séries du genre sélectionné
            $seriesData = $tvModel->getSeriesByGenre($genreId, $page);

            // Ajoute le type "tv" à chaque série
            $series = array_map(function ($serie) {
                $serie['type'] = 'tv'; // Ajoute le type "tv"
                return $serie;
            }, $seriesData['results']);

            $pagination = [
                'total_pages' => $seriesData['total_pages'],
                'current_page' => $seriesData['current_page']
            ];

            // Affiche la vue avec les données
            $view = new View();
            $view->render('tv', [
                'genres' => $genres,
                'series' => $series,
                'pagination' => $pagination,
                'selected_genre' => $genreId
            ]);
        } catch (\Exception $e) {
            $view = new View();
            $view->render('error', ['message' => $e->getMessage()]);
        }
    }
}
