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

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $formData = $form->getData();

            $email = $formData['email'];
            $password = $formData['password'];

            $userRepository = $manager->getRepository(Users::class);
            $user = $userRepository->findOneBy(['email' => $email, 'password' => $password]);

            if (!$user) {
                $this->addFlash('error', 'Invalid username or password');
            } else {
                $this->addFlash('success', 'Verified successfully');
                $this->sessionManager->set('user', 'value_from_first_controller');
            }
        }

        return $this->render('login/index.html.twig', [
            'controller_name' => 'LoginController',
            'form' => $form->createView(),

        ]);
    }
}
