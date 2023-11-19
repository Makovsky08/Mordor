<?php

namespace App\Controller;

use App\Entity\StatusPrispevku;
use App\Form\StatusPrispevkuType;
use App\Repository\StatusPrispevkuRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/status-prispevku')]
class StatusPrispevkuController extends AbstractController
{
    #[Route('/', name: 'app_status_prispevku_index', methods: ['GET'])]
    public function index(StatusPrispevkuRepository $statusPrispevkuRepository): Response
    {
        return $this->render('status-prispevku/index.html.twig', [
            'statusPrispevkus' => $statusPrispevkuRepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'app_status_prispevku_show', methods: ['GET'])]
    public function show(StatusPrispevku $statusPrispevku): Response
    {
        return $this->render('status-prispevku/show.html.twig', [
            'statusPrispevku' => $statusPrispevku,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_status_prispevku_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, StatusPrispevku $statusPrispevku, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(StatusPrispevkuType::class, $statusPrispevku);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_status_prispevku_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('status-prispevku/edit.html.twig', [
            'statusPrispevku' => $statusPrispevku,
            'form' => $form,
        ]);
    }
}
