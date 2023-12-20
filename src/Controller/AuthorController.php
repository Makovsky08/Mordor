<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use App\Security\UserAdapter;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\String\Slugger\SluggerInterface;
use App\Repository\PostRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

#[Route('/author')]
class AuthorController extends AbstractController
{
    private $security;
    private $slugger;

    public function __construct(Security $security, SluggerInterface $slugger)
    {
        $this->security = $security;
        $this->slugger = $slugger;
    }

    #[Route('/', name: 'app_author_index', methods: ['GET'])]
    public function index(PostRepository $postRepository): Response
    {
        $userAdapter = $this->security->getUser();
        $user = $userAdapter->getUserEntity();
        $posts = $postRepository->findBy(['author' => $user]);

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

    #[Route('/show/{id}', name: 'app_author_show', methods: ['GET'])]
    public function show(int $id, PostRepository $postRepository): Response
    {
        $post = $postRepository->find($id);

        if (!$post) {
            throw $this->createNotFoundException('No post found for id '.$id);
        }

        return $this->render('author/show.html.twig', [
            'post' => $post,
        ]);
    }

    #[Route('/new', name: 'app_author_new', methods: ['GET', 'POST'])]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $post = new Post();
        $userAdapter = $this->security->getUser();
        $user = $userAdapter->getUserEntity(); // Get the logged-in user entity

        $post->setAuthor($user); // Set the logged-in user as the author of the post

        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->handleFileUpload($form, $post);
            $entityManager->persist($post);
            $entityManager->flush();

            return $this->redirectToRoute('app_author_index');
        }

        return $this->render('author/new.html.twig', [
            'post' => $post,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/edit/{id}', name: 'app_author_edit', methods: ['GET', 'POST'])]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function edit(Request $request, Post $post, EntityManagerInterface $entityManager): Response
    {
        $userAdapter = $this->security->getUser();
        if ($userAdapter->getUserEntity()->getId() !== $post->getAuthor()->getId()) {
            throw new NotFoundHttpException('Post not found or access denied.');
        }

        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->handleFileUpload($form, $post);
            $entityManager->flush();

            return $this->redirectToRoute('app_author_index');
        }

        return $this->render('author/edit.html.twig', [
            'post' => $post,
            'form' => $form->createView(),
        ]);
    }

    private function handleFileUpload($form, $post)
    {
        /** @var UploadedFile $postDocFile */
        $postDocFile = $form->get('postDocFile')->getData();

        if ($postDocFile) {
            $originalFilename = pathinfo($postDocFile->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFilename = $this->slugger->slug($originalFilename);
            $newFilename = $safeFilename.'-'.uniqid().'.'.$postDocFile->guessExtension();

            try {
                $postDocFile->move(
                    $this->getParameter('post_docs_directory'),
                    $newFilename
                );
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }

            $post->setPostDocName($newFilename);
        }
    }
}
