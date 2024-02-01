<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

;

class UserFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $admin = new User();
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setUsername("Admin");
        $admin->setPassword($this->passwordHasher->hashPassword('ploplop'));
        $manager->persist($admin);
        $user = new User();
        $user->setRoles(['ROLE_USER']);
        $user->setUsername("user");
        $user->setPassword($this->passwordHasher->hashPassword('ploplop'));
        $manager->persist($user);
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
