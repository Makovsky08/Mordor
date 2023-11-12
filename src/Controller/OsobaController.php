<?php

namespace App\Controller;

use App\Entity\Osoba;
use App\Form\OsobaType;
use App\Repository\OsobaRepository;
use App\Security\OsobaUserAdapter;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/osoba')]
class OsobaController extends AbstractController
{
    private $entityManager;
    private $logger;

    public function __construct(EntityManagerInterface $entityManager, LoggerInterface $logger)
    {
        $this->entityManager = $entityManager;
        $this->logger = $logger;
    }

    #[Route('/', name: 'app_osoba_index', methods: ['GET'])]
    public function index(OsobaRepository $osobaRepository): Response
    {
        $this->logger->info('Index method called');

        return $this->render('Osoba/index.html.twig', [
            'osobas' => $osobaRepository->findAll(),

        ]);
    }

    #[IsGranted("ROLE_ADMIN")]
    #[Route('/new', name: 'app_osoba_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        $osoba = new Osoba();
        $form = $this->createForm(OsobaType::class, $osoba);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $osobaAdapter = new OsobaUserAdapter($osoba);

            // Hash the password using the adapter
            $hashedPassword = $passwordHasher->hashPassword(
                $osobaAdapter,
                $osobaAdapter->getPassword()
            );
            $osobaAdapter->setPassword($hashedPassword);

            // Now set the hashed password back to the original Osoba entity
            $osoba->setHeslo($hashedPassword);

            $entityManager->persist($osoba);
            $entityManager->flush();

            return $this->redirectToRoute('app_osoba_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('osoba/new.html.twig', [
            'osoba' => $osoba,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_osoba_show', methods: ['GET'])]
    public function show(Osoba $osoba): Response
    {
        return $this->render('osoba/show.html.twig', [
            'osoba' => $osoba,
        ]);
    }

    #[IsGranted("ROLE_ADMIN")]
    #[Route('/{id}/edit', name: 'app_osoba_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Osoba $osoba, EntityManagerInterface $entityManager): Response
    {
        $this->logger->info('Edit method called', ['value' => $osoba]);

        $form = $this->createForm(OsobaType::class, $osoba);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_osoba_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('osoba/edit.html.twig', [
            'osoba' => $osoba,
            'form' => $form,
        ]);
    }


    #[IsGranted("ROLE_ADMIN")]
    #[Route('/{id}', name: 'app_osoba_delete', methods: ['POST'])]
    public function delete(Request $request, Osoba $osoba, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$osoba->getId(), $request->request->get('_token'))) {
            $entityManager->remove($osoba);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_osoba_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/getter', name: 'osoba_getter')]
    public function getterAction(Request $request)
    {
        $jmeno = $request->query->get('jmeno'); // Získáme hodnotu z URL parametru jmeno
        $jmeno = mb_strtoupper($jmeno); // Převedeme text na velká písmena

        return new Response($jmeno);
    }
}
