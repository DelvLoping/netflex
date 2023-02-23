<?php
// src/Controller/Accueil.php

namespace App\Controller;

use App\Entity\Users;
use App\Entity\Favorites;
use App\Entity\Genre;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccueilController extends AbstractController
{

    /**
     * @Route("/", name="app_home")
     */
    public function home():Response
    {
        return $this->redirectToRoute('app_accueil');
    }

   /**
     * @Route("/accueil", name="app_accueil")
     */
    public function index(ManagerRegistry $doctrine):Response
    {
        $users = $doctrine->getRepository(Favorites::class)->find(35)->getIdUsers();
        $genres = $doctrine->getRepository(Genre::class)->findAll();
        // ...

        //$favorites = $users->getFavorites();
        
        return $this->render('accueil/accueil.html.twig',['favorites'=>$this->getUser()->getFavorites(),'seen'=>$this->getUser()->getSeen(),'genres'=>$genres]);
    }

    
    /**
     * @Route("/profile", name="app_profile")
     */
    public function profile(): Response
    {
        return $this->redirectToRoute('app_users_show',['id'=>$this->getUser()->getId()]);
    }
}