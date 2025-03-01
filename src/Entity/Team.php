<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\TeamRepository;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;

#[ORM\Entity(repositoryClass: TeamRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(
            normalizationContext: ['groups' => ['team:collection:read']],
        ),
        new Get(
            normalizationContext: ['groups' => ['team:item:read']],
        ),
    ],
)]
#[ApiFilter(SearchFilter::class, properties: ['name' => 'exact'])]


class Team
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['team:collection:read', 'team:item:read'])]

    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['event:collection:read', 'event:item:read', 'team:collection:read', 'team:item:read'])]

    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'teams')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['team:collection:read', 'team:item:read'])]

    private ?AgeCategory $age_category = null;

    /**
     * @var Collection<int, Event>
     */
    #[ORM\OneToMany(targetEntity: Event::class, mappedBy: 'team')]
    private Collection $events;

    /**
     * @var Collection<int, Coach>
     */
    #[ORM\OneToMany(targetEntity: Coach::class, mappedBy: 'is_coach_of')]
    #[Groups(['team:item:read'])]

    private Collection $coaches;

    /**
     * @var Collection<int, Player>
     */
    #[ORM\OneToMany(targetEntity: Player::class, mappedBy: 'plays_in')]
    #[Groups(['team:item:read'])]

    private Collection $players;

    public function __construct()
    {
        $this->events = new ArrayCollection();
        $this->coaches = new ArrayCollection();
        $this->players = new ArrayCollection();
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

    #[SerializedName('age_category')]

    public function getAgeCategory(): ?AgeCategory
    {
        return $this->age_category;
    }

    public function setAgeCategory(?AgeCategory $age_category): static
    {
        $this->age_category = $age_category;

        return $this;
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
            $event->setTeam($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): static
    {
        if ($this->events->removeElement($event)) {
            // set the owning side to null (unless already changed)
            if ($event->getTeam() === $this) {
                $event->setTeam(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Coach>
     */
    public function getCoaches(): Collection
    {
        return $this->coaches;
    }

    public function addCoach(Coach $coach): static
    {
        if (!$this->coaches->contains($coach)) {
            $this->coaches->add($coach);
            $coach->setIsCoachOf($this);
        }

        return $this;
    }

    public function removeCoach(Coach $coach): static
    {
        if ($this->coaches->removeElement($coach)) {
            // set the owning side to null (unless already changed)
            if ($coach->getIsCoachOf() === $this) {
                $coach->setIsCoachOf(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Player>
     */
    public function getPlayers(): Collection
    {
        return $this->players;
    }

    public function addPlayer(Player $player): static
    {
        if (!$this->players->contains($player)) {
            $this->players->add($player);
            $player->setPlaysIn($this);
        }

        return $this;
    }

    public function removePlayer(Player $player): static
    {
        if ($this->players->removeElement($player)) {
            // set the owning side to null (unless already changed)
            if ($player->getPlaysIn() === $this) {
                $player->setPlaysIn(null);
            }
        }

        return $this;
    }
}
