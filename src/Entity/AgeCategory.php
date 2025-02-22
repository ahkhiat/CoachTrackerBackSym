<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\AgeCategoryRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: AgeCategoryRepository::class)]
#[ApiResource]
class AgeCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['event:collection:read', 'event:item:read', 'team:collection:read', 'team:item:read'])]
    private ?string $name = null;

    /**
     * @var Collection<int, Team>
     */
    #[ORM\OneToMany(targetEntity: Team::class, mappedBy: 'age_category')]
    private Collection $teams;

    /**
     * @var Collection<int, VisitorTeam>
     */
    #[ORM\OneToMany(targetEntity: VisitorTeam::class, mappedBy: 'age_category')]
    private Collection $visitorTeams;

    public function __construct()
    {
        $this->teams = new ArrayCollection();
        $this->visitorTeams = new ArrayCollection();
    }

    public function __tostring()
    {
        return $this->name;
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

    /**
     * @return Collection<int, Team>
     */
    public function getTeams(): Collection
    {
        return $this->teams;
    }

    public function addTeam(Team $team): static
    {
        if (!$this->teams->contains($team)) {
            $this->teams->add($team);
            $team->setAgeCategory($this);
        }

        return $this;
    }

    public function removeTeam(Team $team): static
    {
        if ($this->teams->removeElement($team)) {
            // set the owning side to null (unless already changed)
            if ($team->getAgeCategory() === $this) {
                $team->setAgeCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, VisitorTeam>
     */
    public function getVisitorTeams(): Collection
    {
        return $this->visitorTeams;
    }

    public function addVisitorTeam(VisitorTeam $visitorTeam): static
    {
        if (!$this->visitorTeams->contains($visitorTeam)) {
            $this->visitorTeams->add($visitorTeam);
            $visitorTeam->setAgeCategory($this);
        }

        return $this;
    }

    public function removeVisitorTeam(VisitorTeam $visitorTeam): static
    {
        if ($this->visitorTeams->removeElement($visitorTeam)) {
            // set the owning side to null (unless already changed)
            if ($visitorTeam->getAgeCategory() === $this) {
                $visitorTeam->setAgeCategory(null);
            }
        }

        return $this;
    }
}
