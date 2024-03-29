<?php

namespace App\Models;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class SessionManagerController
{
    public function set(string $key, $value): void
    {
        // تعيين قيمة لمفتاح في الجلسة
        $_SESSION[$key] = $value;
    }

    public function get(string $key, $default = null)
    {
        // استرجاع قيمة مفتاح من الجلسة، إذا لم يكن موجوداً يتم استرجاع القيمة الافتراضية
        return $_SESSION[$key] ?? $default;
    }

    public function has(string $key): bool
    {
        // التحقق مما إذا كان مفتاح محدد موجود في الجلسة
        return isset($_SESSION[$key]);
    }

    public function remove(string $key): void
    {
        // حذف مفتاح محدد من الجلسة
        unset($_SESSION[$key]);
    }
}
