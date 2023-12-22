<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\StatusPost;
use App\Form\StatusPostType;
use App\Repository\StatusPostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/status-post')]
class StatusPostController extends AbstractController
{
    #[Route('/', name: 'app_status_post_index', methods: ['GET'])]
    public function index(StatusPostRepository $statusPostRepository): Response
    {
        return $this->render('status-post/index.html.twig', [
            'statusPosts' => $statusPostRepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'app_status_post_show', methods: ['GET'])]
    public function show(StatusPost $statusPost): Response
    {
        return $this->render('status-post/show.html.twig', [
            'statusPost' => $statusPost,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_status_post_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, StatusPost $statusPost, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(StatusPostType::class, $statusPost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_status_post_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('status-post/edit.html.twig', [
            'statusPost' => $statusPost,
            'form' => $form,
        ]);
    }
}
