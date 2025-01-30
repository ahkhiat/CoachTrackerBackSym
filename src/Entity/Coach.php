<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CoachRepository;
use Doctrine\ORM\Mapping as ORM;

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
}
