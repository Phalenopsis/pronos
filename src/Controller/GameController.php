<?php

namespace App\Controller;

use App\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/games')]
class GameController extends AbstractController
{
    #[Route('/', name: 'app_game')]
    public function index(GameRepository $gameRepository): Response
    {
        $games = $gameRepository->findPlayedGames();
        return $this->render('game/index.html.twig', [
            'games' => $games,
        ]);
    }

    #[Route('/next', name: 'app_game_next')]
    public function nextGames(GameRepository $gameRepository): Response
    {
        $games = $gameRepository->findNextGames();
        return $this->render('game/next.html.twig', [
            'games' => $games,
        ]);
    }

}
