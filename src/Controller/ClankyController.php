<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClankyController extends AbstractController
{
    #[Route('/clanky', name: 'app_clanky')]
    public function index(): Response
    {
        return $this->render('clanky/index.html.twig', [
            'controller_name' => 'ClankyController',
        ]);
    }
}
