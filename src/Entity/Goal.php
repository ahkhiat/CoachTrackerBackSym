<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\GoalRepository;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: GoalRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(
            normalizationContext: ['groups' => ['goal:collection:read']],
        ),
        new Get(
            normalizationContext: ['groups' => ['goal:item:read']],
        ),
        // Ajoutez d'autres opérations si nécessaire
    ],
)]
#[ApiFilter(SearchFilter::class, properties: ['event' => 'exact'])]
class Goal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['goal:collection:read', 'goal:item:read'])]
    private ?int $minute_goal = null;

    #[ORM\ManyToOne(inversedBy: 'goals')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['goal:collection:read', 'goal:item:read'])]
    private ?Player $player = null;

    #[ORM\ManyToOne(inversedBy: 'goals')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['goal:collection:read', 'goal:item:read'])]
    private ?Event $event = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMinuteGoal(): ?int
    {
        return $this->minute_goal;
    }

    public function setMinuteGoal(int $minute_goal): static
    {
        $this->minute_goal = $minute_goal;

        return $this;
    }

    public function getPlayer(): ?Player
    {
        return $this->player;
    }

    public function setPlayer(?Player $player): static
    {
        $this->player = $player;

        return $this;
    }

    public function getEvent(): ?Event
    {
        return $this->event;
    }

    public function setEvent(?Event $event): static
    {
        $this->event = $event;

        return $this;
    }
}
