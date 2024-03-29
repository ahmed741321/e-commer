<?php

namespace App\Controller\Error;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Config\Definition\Exception\ForbiddenOverwriteException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ErrorController extends AbstractController
{
    #[Route('/error', name: 'app_error')]
    public function index(\Throwable $exception): Response
    {
        if ($exception instanceof NotFoundHttpException) {
            return $this->error_404();
        } elseif ($exception instanceof ForbiddenOverwriteException) {
            return $this->error_403();
        } else {
            return $this->error_500($exception);
        }
    }

    private function error_404(): Response
    {
        return $this->render('error/404.html.twig', [
            'controller_name' => 'ErrorController',
        ]);
    }

    private function error_403(): Response
    {
        return $this->render('error/403.html.twig', [
            'controller_name' => 'ErrorController',
        ]);
    }

    private function error_500(\Throwable $exception): Response
    {
        return $this->render('error/500.html.twig', [
            'controller_name' => 'ErrorController',
            'error_description' => $exception->getMessage(), // تضمين رسالة الخطأ في حالة الخطأ 500
            'error_code' => $exception->getCode(), // تضمين رمز الخطأ في حالة الخطأ 500
            'error_file' => $exception->getFile(), // تضمين مسار الملف الذي حدث فيه الخطأ في حالة الخطأ 500
            'error_line' => $exception->getLine(), // تضمين رقم السطر الذي حدث فيه الخطأ في حالة الخطأ 500
            // يمكنك تضمين معلومات أخرى عن الخطأ حسب الحاجة
        ]);
    }
}
