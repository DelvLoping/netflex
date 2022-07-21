<?php

namespace App\Controller;

use App\Entity\FilmCrew;
use App\Form\FilmCrewType;
use App\Repository\FilmCrewRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/film/crew')]
class FilmCrewController extends AbstractController
{
    #[Route('/', name: 'app_film_crew_index', methods: ['GET'])]
    public function index(FilmCrewRepository $filmCrewRepository): Response
    {
        return $this->render('film_crew/index.html.twig', [
            'film_crews' => $filmCrewRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_film_crew_new', methods: ['GET', 'POST'])]
    public function new(Request $request, FilmCrewRepository $filmCrewRepository): Response
    {
        $filmCrew = new FilmCrew();
        $form = $this->createForm(FilmCrewType::class, $filmCrew);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $filmCrewRepository->add($filmCrew);
            return $this->redirectToRoute('app_film_crew_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('film_crew/new.html.twig', [
            'film_crew' => $filmCrew,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_film_crew_show', methods: ['GET'])]
    public function show(FilmCrew $filmCrew): Response
    {
        return $this->render('film_crew/show.html.twig', [
            'film_crew' => $filmCrew,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_film_crew_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, FilmCrew $filmCrew, FilmCrewRepository $filmCrewRepository): Response
    {
        $form = $this->createForm(FilmCrewType::class, $filmCrew);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $filmCrewRepository->add($filmCrew);
            return $this->redirectToRoute('app_film_crew_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('film_crew/edit.html.twig', [
            'film_crew' => $filmCrew,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_film_crew_delete', methods: ['POST'])]
    public function delete(Request $request, FilmCrew $filmCrew, FilmCrewRepository $filmCrewRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$filmCrew->getId(), $request->request->get('_token'))) {
            $filmCrewRepository->remove($filmCrew);
        }

        return $this->redirectToRoute('app_film_crew_index', [], Response::HTTP_SEE_OTHER);
    }
}
