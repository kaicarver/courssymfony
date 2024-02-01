<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Categorie;
use App\Form\CategorieType;
use Symfony\Component\Security\Http\Attribute\IsGranted;

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
    #[IsGranted('ROLE_USER')]
    public function ajouterCategorie(ManagerRegistry $doctrine, Request $request): Response
    {
        $em = $doctrine->getManager();
        $cat = new Categorie();
        $form = $this->createForm(CategorieType::class, $cat);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($cat);
            $em->flush();
            return $this->redirectToRoute('list_categorie');
        }
        return $this->render('categorie/add.html.twig', [
            'f' => $form
        ]);
    }
    #[Route('/listCategorie', name: 'list_categorie')]
    public function afficherCategories(ManagerRegistry $doctrine): Response
    {
        // recuperer
        $cats = $doctrine->getRepository(Categorie::class)->findAll();
        dump($cats);
        return $this->render('categorie/list.html.twig', [
            'lisCat' => $cats
        ]);
    }
    #[Route('/categorie1', name: 'one_categorie')]
    public function afficherCategorie(ManagerRegistry $doctrine): Response
    {
        // recuperer
        $cat = $doctrine->getRepository(Categorie::class)->find(1);
        dump($cat);
        return $this->render('categorie/categorie.html.twig', [
            'cat' => $cat
        ]);
    }
    #[Route('/categorie2/{id}', name: 'two_categorie')]
    public function afficherCategorie2(Categorie $cat): Response
    {
        // recupereration automatique
        dump($cat);
        return $this->render('categorie/categorie.html.twig', [
            'cat' => $cat
        ]);
    }
    #[Route('/editCategorie/{id}', name: 'edit_categorie')]
    public function modifierCategorie(ManagerRegistry $doctrine, Categorie $cat): Response
    {
        $em = $doctrine->getManager();
        $cat->setNomCat("Matelas");
        $cat->setDescription("lits et matelas");
        $em->flush();
        return $this->redirectToRoute("list_categorie");
    }
    #[Route('/editCategorie1/{id}', name: 'edit1_categorie')]
    public function modifierCategorie1(ManagerRegistry $doctrine, Categorie $cat, Request $request): Response
    {
        $em = $doctrine->getManager();
        $form = $this->createForm(CategorieType::class, $cat);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($cat);
            $em->flush();
            return $this->redirectToRoute('list_categorie');
        }
        return $this->render('categorie/add.html.twig', [
            'f' => $form->createView()
        ]);
    }
    #[Route('/deleteCategorie/{id}', name: 'delete_categorie')]
    public function supprimerCategorie(ManagerRegistry $doctrine, Categorie $cat): Response
    {
        $em = $doctrine->getManager();
        $em->remove($cat);
        $em->flush();
        return $this->redirectToRoute("list_categorie");
    }

}
