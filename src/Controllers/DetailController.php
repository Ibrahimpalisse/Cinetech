<?php
namespace App\Controllers;
session_start();

use App\Views\View;
use App\Models\Details;

class DetailController
{
    public function detail() {
        if (
            isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT) &&
            isset($_GET['type']) && in_array($_GET['type'], ['movie', 'tv'])
        ) {
            $id = $_GET['id'];
            $type = $_GET['type'];

            $detailsModel = new Details();

            if ($type === 'movie') {
                $details = $detailsModel->getDetailsMovies($id);
                $episodes = null;
            } else {
                $details = $detailsModel->getDetailsTvs($id);
                $episodes = $details['episodes'] ?? null;
            }

            if ($details && isset($details['details'])) {
                $view = new View();
                $view->render('details', [
                    'details' => $details['details'],
                    'actors' => $details['actors'] ?? [],
                    'videos' => $details['videos'] ?? [],
                    'episodes' => $episodes,
                    'type' => $type
                ]);
            } else {
                $view = new View();
                $view->render('error', ['message' => 'Détails introuvables.']);
            }
        } else {
            $view = new View();
            $view->render('error', ['message' => 'ID ou type invalide ou manquant.']);
        }
    }
}
?>