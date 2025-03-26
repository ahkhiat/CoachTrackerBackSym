<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\PlayerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\Entity(repositoryClass: PlayerRepository::class)]
#[ApiResource]
class Player
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['event:item:read', 'team:item:read', 'goal:collection:read', 'goal:item:read'])]
    private ?int $id = null;

    /**
     * @var Collection<int, Goal>
     */
    #[ORM\OneToMany(targetEntity: Goal::class, mappedBy: 'player')]
    private Collection $goals;

    /**
     * @var Collection<int, Presence>
     */
    #[ORM\OneToMany(targetEntity: Presence::class, mappedBy: 'player')]
    private Collection $presences;

    #[ORM\ManyToOne(inversedBy: 'players')]
    private ?Team $plays_in = null;

    #[ORM\OneToOne(inversedBy: 'player', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['event:item:read', 'team:item:read', 'goal:collection:read', 'goal:item:read'])]
    private ?User $user = null;

    /**
     * @var Collection<int, Convocation>
     */
    #[ORM\OneToMany(targetEntity: Convocation::class, mappedBy: 'player')]
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
            $goal->setPlayer($this);
        }

        return $this;
    }

    public function removeGoal(Goal $goal): static
    {
        if ($this->goals->removeElement($goal)) {
            // set the owning side to null (unless already changed)
            if ($goal->getPlayer() === $this) {
                $goal->setPlayer(null);
            }
        }

        return $this;
    }
    public function getGoalsCountForCurrentYear(): int
    {
        $year = (new \DateTime())->format('Y');
    
        return $this->getGoals()->filter(function ($goal) use ($year) {
            $eventDateString = $goal->getEvent()->getDate();
            $eventDate = \DateTime::createFromFormat('Y-m-d\TH:i:sP', $eventDateString);
    
            if (!$eventDate) {
                dump("Date invalide : " . $eventDateString);
                return false;
            }
    
            return $eventDate->format('Y') === $year;
        })->count();
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
            $presence->setPlayer($this);
        }

        return $this;
    }

    public function removePresence(Presence $presence): static
    {
        if ($this->presences->removeElement($presence)) {
            // set the owning side to null (unless already changed)
            if ($presence->getPlayer() === $this) {
                $presence->setPlayer(null);
            }
        }

        return $this;
    }
    public function getPresencesCountForCurrentYear(): int
    {
        $year = (new \DateTime())->format('Y');
    
        return $this->getPresences()->filter(function ($presence) use ($year) {
            $eventDateString = $presence->getEvent()->getDate();
            $eventDate = \DateTime::createFromFormat('Y-m-d\TH:i:sP', $eventDateString);
    
            if (!$eventDate) {
                dump("Date invalide : " . $eventDateString);
                return false;
            }
    
            return $eventDate->format('Y') === $year;
        })->count();
    }

    public function getPlaysIn(): ?Team
    {
        return $this->plays_in;
    }

    public function setPlaysIn(?Team $plays_in): static
    {
        $this->plays_in = $plays_in;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): static
    {
        $this->user = $user;

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
            $convocation->setPlayer($this);
        }

        return $this;
    }

    public function removeConvocation(Convocation $convocation): static
    {
        if ($this->convocations->removeElement($convocation)) {
            // set the owning side to null (unless already changed)
            if ($convocation->getPlayer() === $this) {
                $convocation->setPlayer(null);
            }
        }

        return $this;
    }
    
    public function getConvocationsCountForCurrentYear(): int
    {
        $year = (new \DateTime())->format('Y');
    
        return $this->getConvocations()->filter(function ($convocation) use ($year) {
            $eventDateString = $convocation->getEvent()->getDate();
            $eventDate = \DateTime::createFromFormat('Y-m-d\TH:i:sP', $eventDateString);
    
            if (!$eventDate) {
                dump("Date invalide : " . $eventDateString);
                return false;
            }
    
            return $eventDate->format('Y') === $year;
        })->count();
    }
}
