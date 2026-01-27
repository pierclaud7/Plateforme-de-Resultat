<?php

namespace App\Controller;

use App\Repository\DiplomeRepository;
use App\Repository\EtudiantRepository;
use App\Repository\SessionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(
        SessionRepository $sessionRepo,
        EtudiantRepository $etudiantRepo,
        DiplomeRepository $diplomeRepo
    ): Response {
        // 1. Compter les éléments
        $nbSessions = $sessionRepo->count([]);
        $nbEtudiants = $etudiantRepo->count([]);
        $nbDiplomes = $diplomeRepo->count([]);

        // 2. Calculer le taux de réussite global (Admis / Total inscrits)
        // On compte ceux qui ont estAdmis = true
        $nbAdmis = $etudiantRepo->count(['estAdmis' => true]);

        $tauxReussite = 0;
        if ($nbEtudiants > 0) {
            $tauxReussite = round(($nbAdmis / $nbEtudiants) * 100, 1);
        }

        return $this->render('home/index.html.twig', [
            'nbSessions' => $nbSessions,
            'nbEtudiants' => $nbEtudiants,
            'nbDiplomes' => $nbDiplomes,
            'tauxReussite' => $tauxReussite,
        ]);
    }
}
