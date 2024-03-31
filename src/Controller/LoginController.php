<?php

namespace App\Controller;

use App\Form\LoginFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;

class LoginController extends AbstractController
{

    #[Route('/login', name: 'app_login')]
    public function index(EntityManagerInterface $manager, Request $request,SessionInterface $session): Response
    {
        $form = $this->createForm(LoginFormType::class);

        return $this->render('login/index.html.twig', [
            'controller_name' => 'LoginController',
            'form' => $form->createView(),
            'user_name' => $user_name = ($session->has('UserFirstName') ? $session->get('UserFirstName') : null),
        ]);
    }
}
