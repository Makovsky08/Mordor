<?php

namespace App\Controller;

use App\Entity\Prispevek;
use App\Form\PrispevekType;
use App\Repository\PrispevekRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/prispevek')]
class PrispevekController extends AbstractController
{
    #[Route('/', name: 'app_prispevek_index', methods: ['GET'])]
    public function index(PrispevekRepository $prispevekRepository): Response
    {
        $prispeveks = $prispevekRepository->findAll();
        $vydaniData = [];

        // Assuming each Prispevek entity has a method getVydanis() that returns a collection of Vydani entities
        foreach ($prispeveks as $prispevek) {
            $vydaniCollection = $prispevek->getVydanis();
            $vydaniData[$prispevek->getId()] = $vydaniCollection->isEmpty() ? null : $vydaniCollection->toArray();
        }

        return $this->render('prispevek/index.html.twig', [
            'prispeveks' => $prispeveks,
            'vydaniData' => $vydaniData,
        ]);
    }
    

    #[Route('/new', name: 'app_prispevek_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $prispevek = new Prispevek();
        $form = $this->createForm(PrispevekType::class, $prispevek);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($prispevek);
            $entityManager->flush();

            return $this->redirectToRoute('app_prispevek_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('prispevek/new.html.twig', [
            'prispevek' => $prispevek,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_prispevek_show', methods: ['GET'])]
public function show(Prispevek $prispevek): Response
{
    $vydaniCollection = $prispevek->getVydanis();
    $vydani = $vydaniCollection->isEmpty() ? null : $vydaniCollection->first();

    return $this->render('prispevek/show.html.twig', [
        'prispevek' => $prispevek,
        'vydani' => $vydani, // Pass the first (or only) Vydání to the template
    ]);
}

    #[Route('/{id}/edit', name: 'app_prispevek_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Prispevek $prispevek, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PrispevekType::class, $prispevek);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_prispevek_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('prispevek/edit.html.twig', [
            'prispevek' => $prispevek,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_prispevek_delete', methods: ['POST'])]
    public function delete(Request $request, Prispevek $prispevek, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$prispevek->getId(), $request->request->get('_token'))) {
            $entityManager->remove($prispevek);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_prispevek_index', [], Response::HTTP_SEE_OTHER);
    }
}
