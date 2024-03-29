<?php

namespace App\Controller;

use App\Models\SessionManagerController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    private $sessionManager;
    public function __construct(SessionManagerController $sessionManager)
    {
        $this->sessionManager = $sessionManager;
    }

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $user_name = $this->sessionManager->get('user_name');

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'user_name' => $user_name,

        ]);
    }
}
