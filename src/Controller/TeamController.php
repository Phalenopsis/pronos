<?php

namespace App\Controller;

use App\Entity\Team;
use App\Repository\TeamRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TeamController extends AbstractController
{
    #[Route('/team', name: 'app_team')]
    public function index(TeamRepository $teamRepository): Response
    {
        $teams = $teamRepository->findAll();
        return $this->render('team/index.html.twig', [
            'teams' => $teams,
        ]);
    }

    #[Route('/team/show/{team}', name: 'app_team_show')]
    public function show(Team $team): Response
    {
        return $this->render('team/team.html.twig', [
            'team' => $team,
        ]);
    }
}
