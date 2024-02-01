<?php

namespace App\DataFixtures;

use App\Entity\Forecast;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
;

class ForecastFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        for ($player = 0; $player < 10; $player += 1) {
            $nbForecast = rand(0, 5);
            $games = [];
            for ($i = 0; $i < $nbForecast; $i += 1) {
                do {
                    $game = rand(0, 9);
                } while (in_array($game, $games));
                $forecast = new Forecast();
                $forecast->setUser($this->getReference('user_' . $player));
                $forecast->setGame($this->getReference('game_' . $game));
                $forecast->setExpectedResult(rand(0, 2));
                $manager->persist($forecast);
            }
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
          UserFixtures::class,
            GameFixtures::class
        ];
    }
}
