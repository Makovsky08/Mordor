<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Osoba;
use App\Form\OsobaType;
use App\Repository\OsobaRepository;
use App\Security\OsobaUserAdapter;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(OsobaRepository $osobaRepository): Response
    {
        // Fetch all 'Osoba' entities from the database
        $osobas = $osobaRepository->findAll();

        // Render the 'Admin/index.html.twig' template, passing 'osobas' as a variable
        return $this->render('Admin/index.html.twig', [
            'osobas' => $osobas,
        ]);
    }
}