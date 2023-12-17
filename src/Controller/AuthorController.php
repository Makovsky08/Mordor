<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use App\Repository\PostRepository;

#[Route('/author')]
class AuthorController extends AbstractController
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    #[Route('/', name: 'app_author_index', methods: ['GET'])]
public function index(PostRepository $postRepository): Response
{
    $userAdapter = $this->security->getUser();
    if ($userAdapter instanceof UserAdapter) {
        $user = $userAdapter->getUser();
        $userId = $user->getId();
        $posts = $postRepository->findBy(['author' => $userId]);
    } else {
        $this->addFlash('error', 'No valid user logged in.');
        return $this->redirectToRoute('app_login'); // Replace with your actual login route
    }

    $releaseData = [];
    foreach ($posts as $post) {
        $releases = $post->getRelease();
        $releaseData[$post->getId()] = $releases;
    }

    return $this->render('author/index.html.twig', [
        'posts' => $posts,
        'releaseData' => $releaseData,
    ]);
}
    

    

    #[Route('/new', name: 'app_author_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Set the author of the post
            $userAdapter = $this->security->getUser();
            if ($userAdapter instanceof UserAdapter) {
                $user = $userAdapter->getUser(); // Assuming getUser() is implemented in UserAdapter
                $post->setAuthor($user);
            }

            $entityManager->persist($post);
            $entityManager->flush();

            return $this->redirectToRoute('app_author_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('autor/new.html.twig', [
            'post' => $post,
            'form' => $form->createView(),
        ]);
    }
}
