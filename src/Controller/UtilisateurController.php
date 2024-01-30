<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\UtilisateurType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class UtilisateurController extends AbstractController
{
    #[Route('/utilisateur', name: 'app_utilisateur')]
    public function index(): Response
    {
        return $this->render('utilisateur/index.html.twig', [
            'controller_name' => 'UtilisateurController',
        ]);
    }
    #[Route('/addUtilisateur', name: 'add_utilisateur')]
    public function addUtilisateur(ManagerRegistry $doctrine, Request $req, UserPasswordHasherInterface $passwordEncoder): Response
    {
        $user = new Utilisateur;
        $form = $this->createForm(UtilisateurType::class, $user);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword($passwordEncoder->hashPassword($user, $form->get('password')->getData()));
            $user->setEmail($form->get('email')->getData());
            $user->setRoles($form->get('roles')->getData());
            $user->setNom($form->get('nom')->getData());
            $user->setPrenom($form->get('prenom')->getData());
            $em = $doctrine->getManager();
            $em->persist($user);
            $em->flush();
            // redirection login
            return $this->redirectToRoute("app_login");
        }
        return $this->render('utilisateur/add.html.twig', [
            'f' => $form->createView(),
        ]);
    }
}
