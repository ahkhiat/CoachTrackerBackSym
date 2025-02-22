<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CoachRepository;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CoachRepository::class)]
#[ApiResource]
class Coach
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'coaches')]
    private ?Team $is_coach_of = null;

    #[ORM\OneToOne(inversedBy: 'coach', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['team:item:read'])]

    private ?User $user = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIsCoachOf(): ?Team
    {
        return $this->is_coach_of;
    }

    public function setIsCoachOf(?Team $is_coach_of): static
    {
        $this->is_coach_of = $is_coach_of;

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

}
