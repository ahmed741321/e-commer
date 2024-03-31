<?php

namespace App\Controller\API\POST;

use App\Entity\Users;
use App\Entity\Address;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RegisterApiController extends AbstractController
{
    #[Route('api/register', name: 'app_register_api', methods: ['POST'])]
    public function register(EntityManagerInterface $manager, Request $request): JsonResponse
    {
        // استخراج البيانات المرسلة كـ JSON
        $data = json_decode($request->getContent(), true);

        // التحقق من وجود البيانات الأساسية
        $requiredFields = ['firstname', 'lastname', 'email', 'phonenumber', 'Gender', 'password', 'country', 'state', 'city', 'postcode', 'address'];
        foreach ($requiredFields as $field) {
            if (empty($data[$field])) {
                return $this->json(['message' => ucfirst($field) . ' is required'], JsonResponse::HTTP_BAD_REQUEST);
            }
        }

        // التحقق من عدم تكرار الهوية
        $id = rand(time(), 100000000);
        $user_result = $manager->getRepository(Users::class)->find($id);
        if ($user_result !== null) {
            return $this->json(['message' => 'User with the same ID already exists'], JsonResponse::HTTP_BAD_REQUEST);
        }

        // إنشاء مستخدم جديد وعنوان له
        $user = new Users();
        $user->setId($id);
        $user->setFirstName($data['firstname']);
        $user->setLastName($data['lastname']);
        $user->setPhoneNumber($data['phonenumber']);
        $user->setEmail($data['email']);
        $user->setGender($data['Gender']);
        $user->setPassword($data['password']);
        $user->setUserStatus(false);
        $user->setPhotoPath("male");

        $address = new Address();
        $address->setCountry($data['country']);
        $address->setState($data['state']);
        $address->setCity($data['city']);
        $address->setPostCode($data['postcode']);
        $address->setAddress($data['address']);

        $address->setUserId($user);
        $user->addAddress($address);

        // حفظ المستخدم والعنوان في قاعدة البيانات
        $manager->persist($user);
        $manager->flush();

        return $this->json(['message' => 'User registered successfully'], JsonResponse::HTTP_OK);
    }
}
