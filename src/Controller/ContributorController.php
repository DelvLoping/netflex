<?php

namespace App\Controller;

use App\Entity\Contributor;
use App\Form\ContributorType;
use App\Repository\ContributorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/contributor')]
class ContributorController extends AbstractController
{
    #[Route('/', name: 'app_contributor_index', methods: ['GET'])]
    public function index(ContributorRepository $contributorRepository): Response
    {
        return $this->render('contributor/index.html.twig', [
            'contributors' => $contributorRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_contributor_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ContributorRepository $contributorRepository): Response
    {
        $contributor = new Contributor();
        $form = $this->createForm(ContributorType::class, $contributor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contributorRepository->add($contributor);
            return $this->redirectToRoute('app_contributor_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('contributor/new.html.twig', [
            'contributor' => $contributor,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_contributor_show', methods: ['GET'])]
    public function show(Contributor $contributor): Response
    {
        return $this->render('contributor/show.html.twig', [
            'contributor' => $contributor,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_contributor_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Contributor $contributor, ContributorRepository $contributorRepository): Response
    {
        $form = $this->createForm(ContributorType::class, $contributor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contributorRepository->add($contributor);
            return $this->redirectToRoute('app_contributor_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('contributor/edit.html.twig', [
            'contributor' => $contributor,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_contributor_delete', methods: ['POST'])]
    public function delete(Request $request, Contributor $contributor, ContributorRepository $contributorRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$contributor->getId(), $request->request->get('_token'))) {
            $contributorRepository->remove($contributor);
        }

        return $this->redirectToRoute('app_contributor_index', [], Response::HTTP_SEE_OTHER);
    }
}
