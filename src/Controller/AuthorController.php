<?php
declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PostRepository;
use App\Repository\ReleaseRepository;

class AuthorController extends AbstractController
{
    #[Route('/author', name: 'app_author')]
    // AuthorController.php
// ...

public function index(PostRepository $postRepository, ReleaseRepository $releaseRepository): Response
{
    $posts = $postRepository->findAll();

    $releaseData = [];
    foreach ($posts as $post) {
        $releasesCollection = $post->getRelease(); // Assuming this returns a Collection of Release
        $releaseData[$post->getId()] = $releasesCollection;
    }

    return $this->render('author/index.html.twig', [
        'posts' => $posts,
        'releaseData' => $releaseData,
    ]);
}


}
