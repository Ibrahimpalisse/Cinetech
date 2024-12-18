<?php
namespace App\Controllers;
session_start();

use App\Views\View;
use App\Models\Movie;

class MovieController
{
    public function movies() {
        try {
            $moviesModel = new Movie();

            // Récupère tous les genres
            $genres = $moviesModel->getGenres();

            // Définit le genre par défaut sur "Action" (ID 28)
            $defaultGenreId = 28;

            // Récupère l'ID du genre depuis l'URL ou utilise le genre par défaut
            $genreId = isset($_GET['genre']) && filter_var($_GET['genre'], FILTER_VALIDATE_INT) ? $_GET['genre'] : $defaultGenreId;

            // Récupère la page actuelle ou utilise la première page par défaut
            $page = isset($_GET['page']) && filter_var($_GET['page'], FILTER_VALIDATE_INT) ? $_GET['page'] : 1;

            // Récupère les films du genre sélectionné
            $moviesData = $moviesModel->getMoviesByGenre($genreId, $page);

            // Vérifie que les résultats existent
            $movies = isset($moviesData['results']) ? $moviesData['results'] : [];

            // Ajoute le type "tv" à chaque série
            $movies = array_map(function ($movie) {
                if (isset($movie['type']) && $movie['type'] === 'tv') {
                    $movie['type'] = 'tv'; // Ajoute ou modifie le type
                } else {
                    $movie['type'] = 'movie'; // Définit un type par défaut
                }
                return $movie;
            }, $movies);

            // Prépare les données de pagination
            $pagination = [
                'total_pages' => $moviesData['total_pages'] ?? 1,
                'current_page' => $page
            ];

            // Affiche la vue avec les données
            $view = new View();
            $view->render('movies', [
                'genres' => $genres,
                'movies' => $movies,
                'pagination' => $pagination,
                'selected_genre' => $genreId
            ]);
        } catch (\Exception $e) {
            // En cas d'erreur, affiche une page d'erreur
            $view = new View();
            $view->render('error', ['message' => $e->getMessage()]);
        }
    }
}
