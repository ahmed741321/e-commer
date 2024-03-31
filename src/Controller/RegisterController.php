<?php

namespace App\Controller;

use App\Models\RegisterModel;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{


    #[Route('/register', name: 'app_register')]
    public function index(EntityManagerInterface $manager, Request $request, SessionInterface $session): Response
    {
        return $this->render('register/index.html.twig', [
            'controller_name' => 'RegisterController',
            'user_name' => $user_name = ($session->has('UserFirstName') ? $session->get('UserFirstName') : null),
        ]);
        
    }
}
