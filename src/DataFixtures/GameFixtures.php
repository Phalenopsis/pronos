<?php

namespace App\DataFixtures;

use App\Entity\Game;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
;

class GameFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies(): array
    {
        return [
            TeamFixtures::class
        ];
    }
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; $i += 1) {
            $game = new Game();
            $team1Nb = rand(0, 9);
            do{
                $team2Nb = rand(0,9);
            } while ($team2Nb === $team1Nb);
            $game->setTeam1($this->getReference('team_' . $team1Nb));
            $game->setTeam2($this->getReference('team_' . $team2Nb));
            $game->setResult(rand(0,2));
            $manager->persist($game);
            $this->addReference('game_' . $i, $game);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
