<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/pageTexte/{id?}', name: 'text_home')]
    public function page1($id): Response
    {
        return new Response("Hello tout le monde " . $id);
    }

    #[Route('/site', name: 'site_home')]
    public function site(): Response
    {
        return $this->redirect("https://symfony.com");
    }

    #[Route('/redirectHome', name: 'homeredirect_home')]
    public function redirectHome(): Response
    {
        return $this->redirectToRoute("app_home");
    }

    #[Route('/contact', name: 'contact')]
    public function contact(): Response
    {
        $nom = 'boby';
        return $this->render('home/contact.html.twig', ['n' => $nom ]);
    }

    #[Route('/user', name: 'user')]
  public function afficherUtilisateur() : Response
  {
    $users = ['kat', 'john', 'adam', 'Robert'];
    return $this->render('home/user.html.twig', [
                'utilisateurs' => $users
          ]);
  }

}
