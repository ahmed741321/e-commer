<?php
// RegisterController.php

namespace App\Controller;

use App\Models\RegisterModel;
use App\Models\SessionManagerController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
    private $sessionManager;

    public function __construct(SessionManagerController $sessionManager)
    {
        $this->sessionManager = $sessionManager;
    }
    #[Route('/register', name: 'app_register')]
    public function index(EntityManagerInterface $manager, Request $request): Response
    {
        $check = null;

        if ($request->isMethod('POST')) {

            $register = new RegisterModel();
            $registerResult = $register->register($manager, $request);
            $check = $registerResult;
            if ($check == true)
                return  $this->redirectToRoute("app_login");
        }
        $user_name = $this->sessionManager->get('user_name');

        return $this->render('register/index.html.twig', [
            'controller_name' => 'RegisterController',
            'check' => $check,
            'user_name' => $user_name,

        ]);
    }
}
