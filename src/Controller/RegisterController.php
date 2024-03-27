<?php
// RegisterController.php

namespace App\Controller;

use App\Models\RegisterModel;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
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

        return $this->render('register/index.html.twig', [
            'controller_name' => 'RegisterController',
            'check' => $check,
        ]);
    }
}
