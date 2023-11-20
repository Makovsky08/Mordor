<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PrispevekRepository;
use App\Repository\VydaniRepository;

class AutorController extends AbstractController
{
    #[Route('/autor', name: 'app_autor')]
    // AutorController.php
// ...

public function index(PrispevekRepository $prispevekRepository, VydaniRepository $vydaniRepository): Response
{
    $prispevky = $prispevekRepository->findAll();

    $vydaniData = [];
    foreach ($prispevky as $prispevek) {
        $vydaniCollection = $prispevek->getVydanis(); // Assuming this returns a Collection of Vydani
        $vydaniData[$prispevek->getId()] = $vydaniCollection;
    }

    return $this->render('Autor/index.html.twig', [
        'prispevky' => $prispevky,
        'vydaniData' => $vydaniData,
    ]);
}

    
}
