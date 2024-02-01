<?php

namespace App\Entity;

use App\Repository\ForecastRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ForecastRepository::class)]
class Forecast
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'forecasts')]
    private ?Game $game = null;

    #[ORM\ManyToOne(inversedBy: 'forecasts')]
    private ?User $user = null;

    #[ORM\Column(nullable: true)]
    private ?int $expectedResult = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGame(): ?Game
    {
        return $this->game;
    }

    public function setGame(?Game $game): static
    {
        $this->game = $game;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getExpectedResult(): ?int
    {
        return $this->expectedResult;
    }

    public function setExpectedResult(?int $expectedResult): static
    {
        $this->expectedResult = $expectedResult;

        return $this;
    }
}
