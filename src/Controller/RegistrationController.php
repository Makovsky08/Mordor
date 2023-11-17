<?php

// src/Controller/RegistrationController.php

namespace App\Controller;

use App\Form\RegistrationFormType;
use App\Entity\Osoba;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Security\OsobaUserAdapter;

class RegistrationController extends AbstractController
{
    private $entityManager;
    private $logger;

    public function __construct(EntityManagerInterface $entityManager, LoggerInterface $logger)
    {
        $this->entityManager = $entityManager;
        $this->logger = $logger;
    }

    
    #[Route('/register', name: 'app_register', methods: ['GET', 'POST'])]
    public function register(Request $request, UserPasswordHasherInterface $passwordEncoder, EntityManagerInterface $entityManager): Response
    {
        $osoba = new Osoba();
        $form = $this->createForm(RegistrationFormType::class, $osoba);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $osobaAdapter = new OsobaUserAdapter($osoba);

            // Hash the password using the adapter
            $hashedPassword = $passwordEncoder->hashPassword(
                $osobaAdapter,
                $osobaAdapter->getPassword()
            );
            $osobaAdapter->setPassword($hashedPassword);

            // Now set the hashed password back to the original Osoba entity
            $osoba->setHeslo($hashedPassword);

            $entityManager->persist($osoba);
            $entityManager->flush();

            return $this->redirectToRoute('app_prispevek_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('security/registration.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
