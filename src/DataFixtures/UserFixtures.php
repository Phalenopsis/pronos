<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

;

class UserFixtures extends Fixture
{
    const NAMES = ['Bob', 'toto', 'Tata', 'bidule', 'Pokaaron', 'Jean',
                    'Pierre', 'Paul', 'Jack', 'Bernardo'];

    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $admin = new User();
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setUsername("Admin");
        $admin->setPassword($this->passwordHasher->hashPassword($admin, 'ploplop'));
        $manager->persist($admin);
        $user = new User();
        $user->setRoles(['ROLE_USER']);
        $user->setUsername("user");
        $user->setPassword($this->passwordHasher->hashPassword( $user, 'ploplop'));
        $manager->persist($user);
        // $product = new Product();
        // $manager->persist($product);
        foreach (self::NAMES as $i => $name) {
            $user = new User();
            $user->setUsername($name);
            $user->setRoles(['ROLE_USER']);
            $user->setPassword($this->passwordHasher->hashPassword( $user, 'ploplop'));
            $manager->persist($user);
            $this->addReference('user_' . $i, $user);
        }

        $manager->flush();
    }
}
