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
    public function index(PrispevekRepository $prispevekRepository, VydaniRepository $vydaniRepository): Response
    {
        $prispevky = $prispevekRepository->findAll();

        $vydaniData = [];
        foreach ($prispevky as $prispevek) {
            $vydani = $prispevek->getVydanis(); // This should return a Collection of Vydani
            if (!$vydani->isEmpty()) {
                $vydaniData[$prispevek->getId()] = $vydani->first(); 
            }
        }

        return $this->render('Autor/index.html.twig', [
            'prispevky' => $prispevky,
            'vydaniData' => $vydaniData,
        ]);
    }
}
