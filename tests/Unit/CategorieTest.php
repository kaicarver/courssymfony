<?php

namespace App\Tests\Unit;

use App\Entity\Categorie;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CategorieTest extends KernelTestCase
{
    public function testCategorie(): void
    {
        $kernel = self::bootKernel();
        $container = static::getContainer();
        // tester un objet Categorie
        $cat = new Categorie();
        $cat->setNomcat('xy');
        // recuperer erreurs
        $errors = $container->get("validator")->validate($cat);
        $this->assertCount(0, $errors);

        // $this->assertSame('test', $kernel->getEnvironment());
        // $routerService = static::getContainer()->get('router');
        // $myCustomService = static::getContainer()->get(CustomService::class);
    }
    public function testCategorieErreurOk(): void
    {
        $kernel = self::bootKernel();
        $container = static::getContainer();
        // tester un objet Categorie
        $cat = new Categorie();
        $cat->setNomcat('x');
        // recuperer erreurs
        $errors = $container->get("validator")->validate($cat);
        $this->assertCount(1, $errors);

        // $this->assertSame('test', $kernel->getEnvironment());
        // $routerService = static::getContainer()->get('router');
        // $myCustomService = static::getContainer()->get(CustomService::class);
    }
}
