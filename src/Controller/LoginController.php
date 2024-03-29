<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\LoginFormType;
use App\Models\SessionManagerController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class LoginController extends AbstractController
{
    private $sessionManager;

    public function __construct(SessionManagerController $sessionManager)
    {
        $this->sessionManager = $sessionManager;
    }

    #[Route('/login', name: 'app_login')]
    public function index(EntityManagerInterface $manager, Request $request): Response
    {
        $form = $this->createForm(LoginFormType::class);

        $user_name = $this->sessionManager->get('user_name');

        return $this->render('login/index.html.twig', [
            'controller_name' => 'LoginController',
            'form' => $form->createView(),
            'user_name' => $user_name,

        ]);
    }
}
