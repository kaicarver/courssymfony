<?php

namespace App\Tests\Functional;

use App\Entity\Utilisateur;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CategorieTest extends WebTestCase
{
    public function testFormCategorieConnected(): void
    {
        $client = static::createClient();
        $urlGenerator = $client->getContainer()->get('router');
        $entityManager = $client->getContainer()->get('doctrine.orm.entity_manager');
        $user = $entityManager->find(Utilisateur::class, 17);
        $client->loginUser($user);

        $crawler = $client->request(Request::METHOD_GET, $urlGenerator->generate('add_categorie'));

        $form = $crawler->filter('form[name=categorie]')->form([
            'categorie[nomcat]' => 'Catégorie 1',
            'categorie[description]' => 'description de la catégorie 1',
        ]);
        $client->submit($form);
        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
        $client->followRedirect();
        $this->assertRouteSame('list_categorie');
    }
    public function testFormCategorie(): void
    {
        $client = static::createClient();
        $urlGenerator = $client->getContainer()->get('router');

        $crawler = $client->request(Request::METHOD_GET, $urlGenerator->generate('add_categorie'));

        $form = $crawler->filter('form[name=categorie]')->form([
            'categorie[nomcat]' => 'Catégorie 1',
            'categorie[description]' => 'description de la catégorie 1',
        ]);
        $client->submit($form);
        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
        $client->followRedirect();
        $this->assertRouteSame('list_categorie');
    }
}
