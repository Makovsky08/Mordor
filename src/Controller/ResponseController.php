<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\Response;
use App\Entity\Review;
use App\Entity\StatusPost;
use App\Entity\Status;
use App\Form\ResponseType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ResponseController extends AbstractController
{
    #[Route('/response/new/{reviewId}', name: 'response_new')]
    public function new(Request $request, int $reviewId): \Symfony\Component\HttpFoundation\Response
    {
        $response = new Response();
        $review = $this->getDoctrine()->getRepository(Review::class)->find($reviewId);

        if (!$review || $this->getUser() !== $review->getPost()->getAuthor()) {
            throw $this->createNotFoundException('Recenze nebo příspěvek nebyly nalezeny, nebo nemáte oprávnění.');
        }

        $response->setResponseFrom($this->getUser());
        $response->setResponseTo($review->getReviewer());
        $response->setReview($review);
        $response->setRelatedPost($review->getPost());
        $response->setType('Námitka');

        $form = $this->createForm(ResponseType::class, $review);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $statusObjection = $entityManager->getRepository(Status::class)->findOneBy(['title' => 'Námitky odeslány']);

            $post = $review->getPrispevek();

            $newStatusPost = new StatusPost();
            $newStatusPost->setPost($post);
            $newStatusPost->setStatus($statusObjection);
            $newStatusPost->setUpdatedAt(new \DateTime());

            $entityManager->persist($response);
            $entityManager->persist($newStatusPost);
            $entityManager->flush();

            $this->addFlash('success', 'Vaše námitky byly odeslány.');
            return $this->redirectToRoute('post_detail', ['id' => $review->getPost()->getId()]);
        }

        return $this->render('response/new.html.twig', [
            'form' => $form->createView(),
            'post' => $review->getPost()
        ]);
    }

    #[Route('/response/{id}', name: 'app_response_show', methods: ['GET'])]
    public function show(Response $response): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('response/show.html.twig', [
            'response' => $response,
        ]);
    }
}
