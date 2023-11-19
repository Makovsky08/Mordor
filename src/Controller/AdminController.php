<?php
declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(UserRepository $userRepository): Response
    {
        // Fetch all 'User' entities from the database
        $users = $userRepository->findAll();

        // Render the 'Admin/index.html.twig' template, passing 'users' as a variable
        return $this->render('Admin/index.html.twig', [
            'users' => $users,
        ]);
    }
}
