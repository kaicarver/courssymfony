<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CategorieTest extends WebTestCase
{
    public function testSomething(): void
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
