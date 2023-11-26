<?php

namespace App\Controller;

use App\Entity\Reakce;
use App\Entity\Recenze;
use App\Entity\StatusPrispevku;
use App\Entity\Status;
use App\Form\ReakceType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReakceController extends AbstractController
{
    #[Route('/reakce/new/{recenzeId}', name: 'reakce_new')]
    public function new(Request $request, int $recenzeId): Response
    {
        $reakce = new Reakce();
        $recenze = $this->getDoctrine()->getRepository(Recenze::class)->find($recenzeId);

        if (!$recenze || $this->getUser() !== $recenze->getPrispevek()->getAutor()) {
            throw $this->createNotFoundException('Recenze nebo příspěvek nebyly nalezeny, nebo nemáte oprávnění.');
        }

        $reakce->setOdkoho($this->getUser());
        $reakce->setKomu($recenze->getRecenzent());
        $reakce->setRecenze($recenze);
        $reakce->setOdkazovanyPrispevek($recenze->getPrispevek());
        $reakce->setTyp('Námitka');

        $form = $this->createForm(ReakceType::class, $reakce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $statusNamitek = $entityManager->getRepository(Status::class)->findOneBy(['Nazev' => 'Námitky odeslány']);

            $prispevek = $recenze->getPrispevek();

            $novyStatusPrispevku = new StatusPrispevku();
            $novyStatusPrispevku->setPrispevek($prispevek);
            $novyStatusPrispevku->setStatus($statusNamitek);
            $novyStatusPrispevku->setDatumZmeny(new \DateTime());

            $entityManager->persist($reakce);
            $entityManager->persist($novyStatusPrispevku);
            $entityManager->flush();

            $this->addFlash('success', 'Vaše námitky byly odeslány.');
            return $this->redirectToRoute('prispevek_detail', ['id' => $recenze->getPrispevek()->getId()]);
        }

        return $this->render('reakce/new.html.twig', [
            'form' => $form->createView(),
            'prispevek' => $recenze->getPrispevek() 
        ]);
    }
}