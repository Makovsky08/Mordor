<?php
declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PostRepository; // Add the PostRepository

class ArticleController extends AbstractController
{
    private PostRepository $postRepository;

    // Inject PostRepository into the constructor
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    #[Route('/articles', name: 'app_articles')]
    public function index(): Response
    {
        // Fetch posts from the database
        $posts = $this->postRepository->findAll();

        // Pass the posts to the Twig template
        return $this->render('articles/index.html.twig', [
            'posts' => $posts,
        ]);
    }
}
