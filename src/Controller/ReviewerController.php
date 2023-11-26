<?php
declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReviewerController extends AbstractController
{
    #[Route('/reviewer', name: 'app_reviewer')]
    public function index(): Response
    {
        return $this->render('Reviewer/index.html.twig', [
            'controller_name' => 'ReviewerController',
        ]);
    }
}
