<?php

namespace App\DataFixtures;

use App\Entity\Team;
use App\Service\ColorGenerator;
use App\Service\TeamNameGenerator;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;

;

class TeamFixtures extends Fixture
{
    private SluggerInterface $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }
    public function load(ObjectManager $manager): void
    {
        $colorGenerator = new ColorGenerator();
        $nameGenerator = new TeamNameGenerator();
        $teamsNames = [];
        for ($i = 0; $i < 10; $i+=1){
            $team = new Team();
            do {
                $name = $nameGenerator->generate();
            }
            while(in_array($name, $teamsNames));
            $team->setName($name);
            $team->setColor1($colorGenerator->generate());
            $team->setColor2($colorGenerator->generate());
            $team->setColor3($colorGenerator->generate());

            $team->setSlug($this->slugger->slug($name));
            $manager->persist($team);
            $this->addReference('team_' . $i, $team);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
