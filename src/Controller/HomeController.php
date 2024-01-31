<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $user = $this->getUser();
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'user' => $user,
        ]);
    }

    #[Route('/loginorregister', name: 'app_login_or_register')]
    public function loginOrRegister(): Response
    {
        return $this->render('home/login_or_register.html.twig');
    }
}
