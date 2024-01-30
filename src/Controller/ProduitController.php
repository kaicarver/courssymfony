<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Produit;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProduitController extends AbstractController
{
    #[Route('/produit', name: 'app_produit')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();
        $cat = new Categorie();
        $cat->setNomcat("CategorieP");
        for ($i = 0; $i < 3; $i++) {
            $prod = new Produit();
            $prod->setDesignation("produit".$i);
            $prod->setPrix(500);
            $cat->addProduit($prod);
            $em->persist($prod);
        }
        $em->persist($cat);
        $em->flush();
        return $this->render('produit/index.html.twig', [
            'controller_name' => 'ProduitController',
        ]);
    }
}
