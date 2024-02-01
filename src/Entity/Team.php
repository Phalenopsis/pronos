<?php

namespace App\Entity;

use App\Repository\TeamRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TeamRepository::class)]
class Team
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $color1 = null;

    #[ORM\Column(length: 255)]
    private ?string $color2 = null;

    #[ORM\Column(length: 255)]
    private ?string $color3 = null;

    #[ORM\OneToMany(mappedBy: 'team1', targetEntity: Game::class)]
    private Collection $homegames;

    #[ORM\OneToMany(mappedBy: 'team2', targetEntity: Game::class)]
    private Collection $movegames;

    public function __construct()
    {
        $this->homegames = new ArrayCollection();
        $this->movegames = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getColor1(): ?string
    {
        return $this->color1;
    }

    public function setColor1(string $color1): static
    {
        $this->color1 = $color1;

        return $this;
    }

    public function getColor2(): ?string
    {
        return $this->color2;
    }

    public function setColor2(string $color2): static
    {
        $this->color2 = $color2;

        return $this;
    }

    public function getColor3(): ?string
    {
        return $this->color3;
    }

    public function setColor3(string $color3): static
    {
        $this->color3 = $color3;

        return $this;
    }

    /**
     * @return Collection<int, Game>
     */
    public function getHomegames(): Collection
    {
        return $this->homegames;
    }

    public function addHomegame(Game $homegame): static
    {
        if (!$this->homegames->contains($homegame)) {
            $this->homegames->add($homegame);
            $homegame->setTeam1($this);
        }

        return $this;
    }

    public function removeHomegame(Game $homegame): static
    {
        if ($this->homegames->removeElement($homegame)) {
            // set the owning side to null (unless already changed)
            if ($homegame->getTeam1() === $this) {
                $homegame->setTeam1(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Game>
     */
    public function getMovegames(): Collection
    {
        return $this->movegames;
    }

    public function addMovegame(Game $movegame): static
    {
        if (!$this->movegames->contains($movegame)) {
            $this->movegames->add($movegame);
            $movegame->setTeam2($this);
        }

        return $this;
    }

    public function removeMovegame(Game $movegame): static
    {
        if ($this->movegames->removeElement($movegame)) {
            // set the owning side to null (unless already changed)
            if ($movegame->getTeam2() === $this) {
                $movegame->setTeam2(null);
            }
        }

        return $this;
    }
}
