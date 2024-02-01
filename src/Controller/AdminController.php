<?php

namespace App\Controller;

use App\Entity\Game;
use App\Form\GameType;
use App\Form\ResultType;
use App\Repository\GameRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]
class AdminController extends AbstractController
{
    #[Route('/', name: 'app_admin')]
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    #[Route('/show/game/all', name:'app_game_show_all')]
    public function showAll(GameRepository $gameRepository): Response
    {
        return $this->render('game_crud/index.html.twig', [
            'games' => $gameRepository->findAll(),
        ]);
    }
    #[Route('/new', name: 'app_game_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $game = new Game();
        $form = $this->createForm(GameType::class, $game);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($game);
            $entityManager->flush();

            return $this->redirectToRoute('app_game_show_all', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('game_crud/new.html.twig', [
            'game' => $game,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_game_show', methods: ['GET'])]
    public function show(Game $game): Response
    {
        return $this->render('game_crud/show.html.twig', [
            'game' => $game,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_game_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Game $game, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(GameType::class, $game);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_game_show_all', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('game_crud/edit.html.twig', [
            'game' => $game,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_game_delete', methods: ['POST'])]
    public function delete(Request $request, Game $game, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$game->getId(), $request->request->get('_token'))) {
            $entityManager->remove($game);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_game', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/show/coming/all', name: 'app_game_show_all_coming')]
    public function showAllComing(GameRepository $gameRepository): Response
    {

        return $this->render('game_crud/next_all.html.twig', [
            'games' => $gameRepository->findNextGames(),
        ]);
    }

    #[Route('set/coming/{id}', name: 'app_game_set_result')]
    public function setResult(Request $request, Game $game, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ResultType::class, $game);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_game_show_all_coming', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('game_crud/edit.html.twig', [
            'game' => $game,
            'form' => $form,
        ]);
    }
}
