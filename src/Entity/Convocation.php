<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\ConvocationRepository;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\Entity(repositoryClass: ConvocationRepository::class)]
#[ApiResource]
class Convocation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['event:item:read'])]
    private ?int $status = null;

    #[ORM\ManyToOne(inversedBy: 'convocations')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['event:item:read'])]
    private ?Player $player = null;

    #[ORM\ManyToOne(inversedBy: 'convocations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Event $event = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): static
    {
        $this->status = $status;

        return $this;
    }
    // public const STATUS_PENDING = 'pending';
    // public const STATUS_ACCEPTED = 'accepted';
    // public const STATUS_REFUSED = 'refused';

    // #[ApiProperty]
    // public static function getAvailableStatuses(): array
    // {
    //     return [
    //         self::STATUS_PENDING,
    //         self::STATUS_ACCEPTED,
    //         self::STATUS_REFUSED,
    //     ];
    // }

    // public function setStatus(string $status): self
    // {
    //     if (!in_array($status, self::getAvailableStatuses())) {
    //         throw new \InvalidArgumentException("Statut invalide");
    //     }
    //     $this->status = $status;
    //     return $this;
    // }

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
