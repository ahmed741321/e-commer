<?php


namespace App\Models;

use App\Entity\Address;
use App\Entity\Users;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\Null_;

class RegisterModel
{
    public static function register(EntityManagerInterface $manager, Request $request)
    {
        $firstname = $request->request->get('firstname');
        $lastname = $request->request->get('lastname');
        $email = $request->request->get('email');
        $phonenumber = $request->request->get('phonenumber');
        $gender = $request->request->get('Gender');
        $password = $request->request->get('password');

        $user = new Users();
        $id  = rand(time(), 100000000);
        $user_result = $manager->getRepository(Users::class)->find($id);

        if ($user_result == null) {
            $user->setId($id);
            $user->setFirstName($firstname);
            $user->setLastName($lastname);
            $user->setPhoneNumber($phonenumber);
            $user->setEmail($email);
            $user->setGender($gender);
            $user->setPassword($password);
            $user->setUserStatus(false);
            $user->setPhotoPath("male");

            $address = new Address();
            $address->setCountry($request->request->get('country'));
            $address->setState($request->request->get('state'));
            $address->setCity($request->request->get('city'));
            $address->setPostCode($request->request->get('postcode'));
            $address->setAddress($request->request->get('address'));

            $address->setUserId($user);
            $user->addAddress($address);

            $manager->persist($user);
            $manager->flush();

            return true;
        } else {
            return false;
        }
    }
}
