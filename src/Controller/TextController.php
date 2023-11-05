<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\VarDumper\VarDumper;

class TextController extends AbstractController
{
    #[Route('/text', name: 'text')]
    public function index(): Response
    {
        $text = "HOLIK07 TEXT UPPERCASE";

        $variableToDump = 'Hello, this will be dumped';

        VarDumper::dump($variableToDump);

        return $this->render('text/index.html.twig', [
            'text' => $text,
        ]);
    }

    #[Route('/poslipole', name: 'poslipole')]
    public function poslipoleAction(): Response
    {
        $data = [
            'holik07' => 'Tomáš Holík',
            'polozka2' => 'Hodnota 2',
            'polozka3' => 'Hodnota 3',
        ];

        return $this->render('text/index.html.twig', [
            'data' => $data,
        ]);
    }

    #[Route('/poslipolevpoli', name: 'poslipolevpoli')]
    public function poslipolevpoliAction(): Response
    {
        $people = [
            ['jmeno' => 'Tomáš', 'prijmeni' => 'Holík'],
            ['jmeno' => 'Marcus', 'prijmeni' => 'Aurelius'],
            ['jmeno' => 'Lucius', 'prijmeni' => 'Seneca'],
            ['jmeno' => 'Epiktétos', 'prijmeni' => 'Epiktétos'],
        ];

        return $this->render('text/index.html.twig', [
            'people' => $people,
        ]);
    }
}
