<?php

namespace App\Controller;

use App\Entity\Seen;
use App\Form\SeenType;
use App\Repository\SeenRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/seen')]
class SeenController extends AbstractController
{
    #[Route('/', name: 'app_seen_index', methods: ['GET'])]
    public function index(SeenRepository $seenRepository): Response
    {
        return $this->render('seen/index.html.twig', [
            'seens' => $seenRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_seen_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SeenRepository $seenRepository): Response
    {
        $seen = new Seen();
        $form = $this->createForm(SeenType::class, $seen);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $seenRepository->add($seen);
            return $this->redirectToRoute('app_seen_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('seen/new.html.twig', [
            'seen' => $seen,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_seen_show', methods: ['GET'])]
    public function show(Seen $seen): Response
    {
        return $this->render('seen/show.html.twig', [
            'seen' => $seen,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_seen_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Seen $seen, SeenRepository $seenRepository): Response
    {
        $form = $this->createForm(SeenType::class, $seen);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $seenRepository->add($seen);
            return $this->redirectToRoute('app_seen_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('seen/edit.html.twig', [
            'seen' => $seen,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_seen_delete', methods: ['POST'])]
    public function delete(Request $request, Seen $seen, SeenRepository $seenRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$seen->getId(), $request->request->get('_token'))) {
            $seenRepository->remove($seen);
        }

        return $this->redirectToRoute('app_seen_index', [], Response::HTTP_SEE_OTHER);
    }
}
