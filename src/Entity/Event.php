<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiFilter;
use App\Repository\EventRepository;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use Doctrine\Common\Collections\ArrayCollection;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;



#[ORM\Entity(repositoryClass: EventRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(
            normalizationContext: ['groups' => ['event:collection:read']],
        ),
        new Get(
            normalizationContext: ['groups' => ['event:item:read']],
        ),
        // Ajoutez d'autres opérations si nécessaire
    ],
)]
#[ApiFilter(SearchFilter::class, properties: ['team.name' => 'exact'])]
#[ApiFilter(OrderFilter::class, properties: ['date' => 'DESC'])]

class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['event:collection:read', 'event:item:read', 'goal:collection:read', 'goal:item:read'])]

    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['event:collection:read', 'event:item:read'])]

    private ?\DateTime $date = null;


    /**
     * @var Collection<int, Goal>
     */
    #[ORM\OneToMany(targetEntity: Goal::class, mappedBy: 'event')]
    private Collection $goals;

    #[ORM\ManyToOne(inversedBy: 'events')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['event:collection:read', 'event:item:read'])]

    private ?EventType $event_type = null;

    #[ORM\ManyToOne(inversedBy: 'events')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['event:collection:read', 'event:item:read'])]

    private ?Team $team = null;

    #[ORM\ManyToOne(inversedBy: 'events')]
    #[ORM\JoinColumn(nullable: true)]
    #[Groups(['event:collection:read', 'event:item:read'])]

    private ?VisitorTeam $visitor_team = null;

    #[ORM\ManyToOne(inversedBy: 'events')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['event:collection:read', 'event:item:read'])]

    private ?Stadium $stadium = null;

    #[ORM\ManyToOne(inversedBy: 'events')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['event:collection:read', 'event:item:read'])]

    private ?Season $season = null;

    /**
     * @var Collection<int, Presence>
     */
    #[ORM\OneToMany(targetEntity: Presence::class, mappedBy: 'event')]
    #[Groups(['event:item:read'])]
    private Collection $presences;

    /**
     * @var Collection<int, Convocation>
     */
    #[ORM\OneToMany(targetEntity: Convocation::class, mappedBy: 'event')]
    #[Groups(['event:item:read'])]
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


    #[Groups(['event:collection:read', 'event:item:read'])]
    public function getIsInProgress(): bool
    {
        
        $now = new \DateTime('now', new \DateTimeZone('Europe/Paris'));
        $now->setTime($now->format('H'), $now->format('i'), 0); 

        $startTime = \DateTime::createFromFormat('Y-m-d\TH:i:sP', $this->date->format('Y-m-d\TH:i:sP'));
        $startTime->setTime($startTime->format('H'), $startTime->format('i'), 0); 
        
        $endTime = (clone $startTime)->modify("+2 hours");
        $endTime->setTime($endTime->format('H'), $endTime->format('i'), 0);
        
        // dump("Now (): " . $now->format('Y-m-d H:i:s'));
        // dump("Start (): " . $startTime->format('Y-m-d H:i:s'));
        // dump("End (): " . $endTime->format('Y-m-d H:i:s'));

        // dump([
        //     'now' => $now->format('Y-m-d H:i:s'),
        //     'start' => $startTime->format('Y-m-d H:i:s'),
        //     'end' => $endTime->format('Y-m-d H:i:s'),
        //     'now >= start' => var_export($now >= $startTime, true),
        //     'now <= end' => var_export($now <= $endTime, true),
        //     'final_result' => var_export($now >= $startTime && $now <= $endTime, true),
        // ]);

        return $now >= $startTime && $now <= $endTime;
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
    #[Groups(['event:collection:read'])]
    public function getHasConvocations(): bool
    {
        return !$this->convocations->isEmpty();
    }
    // modif

    #[Groups(['event:collection:read'])]
    public function getHasPresences(): bool
    {
        return !$this->presences->isEmpty();
    }

}
