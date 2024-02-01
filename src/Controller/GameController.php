<?php

namespace App\Controller;

use App\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends AbstractController
{
    #[Route('/games', name: 'app_game')]
    public function index(GameRepository $gameRepository): Response
    {
        $games = $gameRepository->findPlayedGames();
        return $this->render('game/index.html.twig', [
            'games' => $games,
        ]);
    }
}
