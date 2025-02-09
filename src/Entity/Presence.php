<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\PresenceRepository;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PresenceRepository::class)]
#[ApiResource]
class Presence
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['event:item:read'])]
    private ?bool $on_time = null;

    #[ORM\ManyToOne(inversedBy: 'presences')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['event:item:read'])]
    private ?Player $player = null;

    #[ORM\ManyToOne(inversedBy: 'presences')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Event $event = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isOnTime(): ?bool
    {
        return $this->on_time;
    }

    public function setOnTime(bool $on_time): static
    {
        $this->on_time = $on_time;

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
