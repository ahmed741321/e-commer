<?php

namespace App\Models;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;
use Symfony\Component\HttpFoundation\Response;

class PrivateAssetController extends AbstractController
{
    public function index($filename): Response
    {
        // Assuming your JavaScript files are stored in the 'private/' directory
        $filePath = $this->getParameter('kernel.project_dir') . '/private/' . $filename;

        // Check if the file exists
        if (!file_exists($filePath)) {
            throw new FileNotFoundException();
        }

        // Read the file content
        $content = file_get_contents($filePath);

        // Create a response with the file content
        $response = new Response($content);

        // Set content type to JavaScript
        $response->headers->set('Content-Type', 'text/javascript');

        return $response;
    }
}
