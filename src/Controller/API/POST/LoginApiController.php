<?php

namespace App\Controller\API\POST;

use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class LoginApiController extends AbstractController
{


    #[Route('/api/login', name: 'api_login', methods: ['POST'])]
    public function login(EntityManagerInterface $manager, Request $request, SessionInterface $session): JsonResponse
    {
        // استخراج البيانات المرسلة كـ JSON
        $data = json_decode($request->getContent(), true);

        // التأكد من وجود البريد الإلكتروني وكلمة المرور في البيانات المرسلة
        if (!isset($data['email']) || !isset($data['password'])) {
            return $this->json(['message' => 'Email and password are required'], JsonResponse::HTTP_BAD_REQUEST);
        }

        // استخراج البريد الإلكتروني وكلمة المرور من البيانات المرسلة
        $email = $data['email'];
        $password = $data['password'];

        // البحث عن المستخدم في قاعدة البيانات
        $userRepository = $manager->getRepository(Users::class);
        $user = $userRepository->findOneBy(['email' => $email, 'password' => $password]);




        if ($user) {
            $session->set('UserFirstName', $user->getFirstName());
            return $this->json(['message' => 'Login successful'], JsonResponse::HTTP_OK);
        }

        return $this->json(['message' => 'Invalid username or password'], JsonResponse::HTTP_UNAUTHORIZED);
    }
}
