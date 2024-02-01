<?php

namespace App\DataFixtures;

use App\Entity\Utilisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Generator;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $userPasswordHasherInterface;
    private Generator $faker;

    public function __construct(UserPasswordHasherInterface $userPasswordHasherInterface) {
        $this->userPasswordHasherInterface = $userPasswordHasherInterface;
        $this->faker = Factory::create("fr_FR");
    }
    public function load(ObjectManager $manager): void
    {
        $users = [];
        $admin = new Utilisateur();
        $admin->setEmail('admin@gmail.com');
        $admin->setRoles(['ROLE_USER', 'ROLE_ADMIN']);
        $admin->setPassword($this->userPasswordHasherInterface->hashPassword($admin, 'adminadmin'));
        $users[] = $admin;
        $manager->persist($admin);

        // ajouter 10 users
        for ($i = 0; $i < 10; $i++) {
            $user = new Utilisateur();
            $user->setEmail($this->faker->email());
            $user->setRoles(['ROLE_USER']);
            $user->setPassword($this->userPasswordHasherInterface->hashPassword($user, 'password'));
            $user->setNom($this->faker->name());
            $user->setPrenom($this->faker->firstName());
            $manager->persist($user);
        }

        $manager->flush();
    }
}
