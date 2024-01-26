<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Categorie;

class CategorieController extends AbstractController
{
    #[Route('/categorie', name: 'app_categorie')]
    public function index(): Response
    {
        return $this->render('categorie/index.html.twig', [
            'controller_name' => 'CategorieController',
        ]);
    }
    #[Route('/addCategorie', name: 'add_categorie')]
    public function ajouterCategorie(ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();
        $cat = new Categorie();
        $cat->setNomCat("Salon");
        $cat->setDescription("etc");
        $em->persist($cat);
        $em->flush();
        return $this->redirectToRoute("list_categorie");
    }
    #[Route('/listCategorie', name: 'list_categorie')]
    public function afficherCategories(ManagerRegistry $doctrine): Response
    {
        // recuperer
        $cats = $doctrine->getRepository(Categorie::class)->findAll();
        return $this->render
        ('categorie/list.html.twig', [
            'lisCat' => $cats
        ]);
    }
}
