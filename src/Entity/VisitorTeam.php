<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\VisitorTeamRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: VisitorTeamRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(
            normalizationContext: ['groups' => ['visitorTeam:collection:read']],
        ),
        new Get(
            normalizationContext: ['groups' => ['visitorTeam:item:read']],
        ),
    ],
)]
class VisitorTeam
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['visitorTeam:collection:read', 'visitorTeam:item:read'])]
    private ?int $id = null;

    
    /**
     * @var Collection<int, Event>
     */
    #[ORM\OneToMany(targetEntity: Event::class, mappedBy: 'visitor_team')]
    private Collection $events;

    #[ORM\ManyToOne(inversedBy: 'visitorTeams')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['event:collection:read', 'event:item:read', 'visitorTeam:collection:read', 'visitorTeam:item:read'])]


    private ?Club $club = null;

    #[ORM\ManyToOne(inversedBy: 'visitorTeams')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['event:collection:read', 'event:item:read'])]

    private ?AgeCategory $age_category = null;

    public function __construct()
    {
        $this->events = new ArrayCollection();
    }

    public function __tostring()
    {
        return $this->club->getName() . " - " . $this->age_category;
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    /**
     * @return Collection<int, Event>
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(Event $event): static
    {
        if (!$this->events->contains($event)) {
            $this->events->add($event);
            $event->setVisitorTeam($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): static
    {
        if ($this->events->removeElement($event)) {
            // set the owning side to null (unless already changed)
            if ($event->getVisitorTeam() === $this) {
                $event->setVisitorTeam(null);
            }
        }

        return $this;
    }

    public function getClub(): ?Club
    {
        return $this->club;
    }

    public function setClub(?Club $club): static
    {
        $this->club = $club;

        return $this;
    }

    public function getAgeCategory(): ?AgeCategory
    {
        return $this->age_category;
    }

    public function setAgeCategory(?AgeCategory $age_category): static
    {
        $this->age_category = $age_category;

        return $this;
    }
}
