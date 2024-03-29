<?php

namespace App\Controller\API;

use App\Entity\Users;
use App\Form\LoginFormType;
use App\Models\SessionManagerController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class LoginApiController extends AbstractController
{
    private $sessionManager;

    public function __construct(SessionManagerController $sessionManager)
    {
        $this->sessionManager = $sessionManager;
    }

    #[Route('/api/login', name: 'api_login', methods: ['POST'])]
    public function login(EntityManagerInterface $manager, Request $request): JsonResponse
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

        // التحقق مما إذا كان المستخدم موجودًا وإذا كانت كلمة المرور صحيحة
        if ($user) {
            // يمكنك هنا تعيين الجلسة أو إنشاء رمز JWT للمصادقة
            $this->sessionManager->set('user_name', $user->getFirstName());
            return $this->json(['message' => 'Login successful'], JsonResponse::HTTP_OK);
        }

        // في حالة عدم وجود المستخدم أو كلمة المرور غير صحيحة
        return $this->json(['message' => 'Invalid username or password'], JsonResponse::HTTP_UNAUTHORIZED);
    }
}
