<?php

namespace App\Controller;

use App\Entity\Categorize;
use App\Form\CategorizeType;
use App\Repository\CategorizeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/categorize')]
class CategorizeController extends AbstractController
{
    #[Route('/', name: 'app_categorize_index', methods: ['GET'])]
    public function index(CategorizeRepository $categorizeRepository): Response
    {
        return $this->render('categorize/index.html.twig', [
            'categorizes' => $categorizeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_categorize_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CategorizeRepository $categorizeRepository): Response
    {
        $categorize = new Categorize();
        $form = $this->createForm(CategorizeType::class, $categorize);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categorizeRepository->add($categorize);
            return $this->redirectToRoute('app_categorize_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('categorize/new.html.twig', [
            'categorize' => $categorize,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_categorize_show', methods: ['GET'])]
    public function show(Categorize $categorize): Response
    {
        return $this->render('categorize/show.html.twig', [
            'categorize' => $categorize,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_categorize_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Categorize $categorize, CategorizeRepository $categorizeRepository): Response
    {
        $form = $this->createForm(CategorizeType::class, $categorize);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categorizeRepository->add($categorize);
            return $this->redirectToRoute('app_categorize_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('categorize/edit.html.twig', [
            'categorize' => $categorize,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_categorize_delete', methods: ['POST'])]
    public function delete(Request $request, Categorize $categorize, CategorizeRepository $categorizeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categorize->getId(), $request->request->get('_token'))) {
            $categorizeRepository->remove($categorize);
        }

        return $this->redirectToRoute('app_categorize_index', [], Response::HTTP_SEE_OTHER);
    }
}
