<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecenzentController extends AbstractController
{
    #[Route('/recenzent', name: 'app_recenzent')]
    public function index(): Response
    {
        return $this->render('recenzent/index.html.twig', [
            'controller_name' => 'RecenzentController',
        ]);
    }
}
