<?php

namespace App\Controller;

use App\Models\SessionManagerController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class HomeController extends AbstractController
{

    #[Route('/', name: 'app_home')]
    public function index(SessionInterface $session): Response
    {

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'user_name' => $user_name = ($session->has('UserFirstName') ? $session->get('UserFirstName') : null),

        ]);
    }
}
