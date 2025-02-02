<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiFilter;
use App\Repository\EventRepository;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: EventRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['event:read']],
    denormalizationContext: ['groups' => ['event:write']]
)]
#[ApiFilter(SearchFilter::class, properties: ['team' => 'exact'])]


class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['event:read'])]

    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['event:read', 'event:write'])]

    private ?\DateTime $date = null;

    /**
     * @var Collection<int, Goal>
     */
    #[ORM\OneToMany(targetEntity: Goal::class, mappedBy: 'event')]
    private Collection $goals;

    #[ORM\ManyToOne(inversedBy: 'events')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['event:read', 'event:write'])]

    private ?EventType $event_type = null;

    #[ORM\ManyToOne(inversedBy: 'events')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['event:read', 'event:write'])]

    private ?Team $team = null;

    #[ORM\ManyToOne(inversedBy: 'events')]
    #[ORM\JoinColumn(nullable: true)]
    #[Groups(['event:read', 'event:write'])]

    private ?VisitorTeam $visitor_team = null;

    #[ORM\ManyToOne(inversedBy: 'events')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['event:read', 'event:write'])]

    private ?Stadium $stadium = null;

    #[ORM\ManyToOne(inversedBy: 'events')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['event:read', 'event:write'])]

    private ?Season $season = null;

    /**
     * @var Collection<int, Presence>
     */
    #[ORM\OneToMany(targetEntity: Presence::class, mappedBy: 'event')]
    private Collection $presences;

    /**
     * @var Collection<int, Convocation>
     */
    #[ORM\OneToMany(targetEntity: Convocation::class, mappedBy: 'event')]
    private Collection $convocations;

    public function __construct()
    {
        $this->goals = new ArrayCollection();
        $this->presences = new ArrayCollection();
        $this->convocations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    // public function getDate(): ?\DateTimeInterface
    // {
    //     return $this->date;
    // }

    public function getDate(): string
    {
        return $this->date->format(\DateTime::ATOM); // Format ISO 8601
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Collection<int, Goal>
     */
    public function getGoals(): Collection
    {
        return $this->goals;
    }

    public function addGoal(Goal $goal): static
    {
        if (!$this->goals->contains($goal)) {
            $this->goals->add($goal);
            $goal->setEvent($this);
        }

        return $this;
    }

    public function removeGoal(Goal $goal): static
    {
        if ($this->goals->removeElement($goal)) {
            // set the owning side to null (unless already changed)
            if ($goal->getEvent() === $this) {
                $goal->setEvent(null);
            }
        }

        return $this;
    }

    public function getEventType(): ?EventType
    {
        return $this->event_type;
    }

    public function setEventType(?EventType $event_type): static
    {
        $this->event_type = $event_type;

        return $this;
    }

    public function getTeam(): ?Team
    {
        return $this->team;
    }

    public function setTeam(?Team $team): static
    {
        $this->team = $team;

        return $this;
    }

    public function getVisitorTeam(): ?VisitorTeam
    {
        return $this->visitor_team;
    }

    public function setVisitorTeam(?VisitorTeam $visitor_team): static
    {
        $this->visitor_team = $visitor_team;

        return $this;
    }

    public function getStadium(): ?Stadium
    {
        return $this->stadium;
    }

    public function setStadium(?Stadium $stadium): static
    {
        $this->stadium = $stadium;

        return $this;
    }

    public function getSeason(): ?Season
    {
        return $this->season;
    }

    public function setSeason(?Season $season): static
    {
        $this->season = $season;

        return $this;
    }

    /**
     * @return Collection<int, Presence>
     */
    public function getPresences(): Collection
    {
        return $this->presences;
    }

    public function addPresence(Presence $presence): static
    {
        if (!$this->presences->contains($presence)) {
            $this->presences->add($presence);
            $presence->setEvent($this);
        }

        return $this;
    }

    public function removePresence(Presence $presence): static
    {
        if ($this->presences->removeElement($presence)) {
            // set the owning side to null (unless already changed)
            if ($presence->getEvent() === $this) {
                $presence->setEvent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Convocation>
     */
    public function getConvocations(): Collection
    {
        return $this->convocations;
    }

    public function addConvocation(Convocation $convocation): static
    {
        if (!$this->convocations->contains($convocation)) {
            $this->convocations->add($convocation);
            $convocation->setEvent($this);
        }

        return $this;
    }

    public function removeConvocation(Convocation $convocation): static
    {
        if ($this->convocations->removeElement($convocation)) {
            // set the owning side to null (unless already changed)
            if ($convocation->getEvent() === $this) {
                $convocation->setEvent(null);
            }
        }

        return $this;
    }
}
