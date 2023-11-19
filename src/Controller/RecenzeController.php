<?php

namespace App\Controller;


use App\Entity\Recenze;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Form\RecenzeType;
use App\Repository\RecenzeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/recenze')]
class RecenzeController extends AbstractController
{
    #[Route('/', name: 'app_recenze_index', methods: ['GET'])]
    public function index(RecenzeRepository $recenzeRepository): Response
    {
        return $this->render('recenze/index.html.twig', [
            'recenzes' => $recenzeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_recenze_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $recenze = new Recenze();
        $form = $this->createForm(RecenzeType::class, $recenze);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($recenze);
            $entityManager->flush();

            return $this->redirectToRoute('app_recenze_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('recenze/new.html.twig', [
            'recenze' => $recenze,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_recenze_show', methods: ['GET'])]
    public function show(Recenze $recenze): Response
    {
        return $this->render('recenze/show.html.twig', [
            'recenze' => $recenze,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_recenze_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Recenze $recenze, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RecenzeType::class, $recenze);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_recenze_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('recenze/edit.html.twig', [
            'recenze' => $recenze,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_recenze_delete', methods: ['POST'])]
    public function delete(Request $request, Recenze $recenze, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$recenze->getId(), $request->request->get('_token'))) {
            $entityManager->remove($recenze);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_recenze_index', [], Response::HTTP_SEE_OTHER);
    }
}
