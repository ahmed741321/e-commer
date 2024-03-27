<?php

namespace App\Models;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class SessionManagerController extends AbstractController
{
    private $sessionData;

    public function __construct()
    {
        $this->sessionData = [];
    }
    public function set(string $key, $value): void
    {
        $this->sessionData[$key] = $value;
    }

    public function get(string $key, $default = null)
    {
        return $this->sessionData[$key] ?? $default;
    }

    public function has(string $key): bool
    {
        return isset($this->sessionData[$key]);
    }

    public function remove(string $key): void
    {
        unset($this->sessionData[$key]);
    }
}
