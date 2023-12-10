<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\ResponseRequest;
use App\Entity\VersionPost;
use App\Form\ReviewerSelectType;
use App\Repository\UserRepository;
use App\Repository\VersionPostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EditorController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager
    ) {}

    #[Route('/editor', name: 'app_editor')]
    public function index(VersionPostRepository $versionPostRepository): Response
    {
        return $this->render('editor/index.html.twig', [
            'articles' => $versionPostRepository->findAll(),
            'form' => $this->createForm(ReviewerSelectType::class),
        ]);
    }

    #[Route('/editor/save/status/{id}/{status}', name: 'status')]
    public function saveStatus(Request $request, VersionPost $versionPost, string $status): Response
    {
        $versionPost->setStatus($status);
        $this->entityManager->flush();
        $this->addFlash('success', 'Status saved successfully.');

        return $this->redirectToRoute('app_editor');
    }

    // todo: doresit vyber recenzentu a ulozeni vyberu k pozadavke na recenzi

    #[Route('/editor/select/reviewer', name: 'select_reviewer')]
    public function selectReviewer(Request $request): Response
    {
        $form = $this->createForm(ReviewerSelectType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $selectedReviewerId = $form->get('reviewer_id')->getData();

            // Ak chcete ihneď uložiť hodnotu, môžete volať akciu na uloženie recenzenta s týmto ID
            // Prípadne môžete len zobraziť potvrdenie, že hodnota bola vybratá
            return $this->redirectToRoute('editor/save_reviewer', ['reviewer_id' => $selectedReviewerId]);
        }

        return $this->render('editor/select_reviewer.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/save/reviewer', name: 'save_reviewer')]
    public function saveReviewer(Request $request, UserRepository $userRepository): Response
    {
        $selectedReviewerId = $request->request->get('reviewer_id');

        // Vytvorte nový objekt ResponseRequest
        $responseRequest = new ResponseRequest();
        $reviewer = $userRepository->find($selectedReviewerId);
        $responseRequest->setReviewer($reviewer);

        // Uložte do databázy
        $this->entityManager->persist($responseRequest);
        $this->entityManager->flush();

        // Prípadne môžete pridať správu alebo presmerovať na inú stránku
        $this->addFlash('success', 'Reviewer ID saved successfully.');

        return $this->redirectToRoute('app_editor'); // Nahraďte 'your_index_route' svojou existujúcou trasou.
    }
}
