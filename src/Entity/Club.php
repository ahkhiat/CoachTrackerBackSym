<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ClubRepository;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ClubRepository::class)]
#[ApiResource]
class Club
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['event:collection:read', 'event:item:read'])]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $adress = null;

    #[ORM\Column(length: 255)]
    private ?string $postal_code = null;

    #[ORM\Column(length: 255)]
    private ?string $town = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['event:collection:read', 'event:item:read'])]
    private ?string $image_name = null;

    /**
     * @var Collection<int, VisitorTeam>
     */
    #[ORM\OneToMany(targetEntity: VisitorTeam::class, mappedBy: 'club')]
    private Collection $visitorTeams;

    public function __construct()
    {
        $this->visitorTeams = new ArrayCollection();
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

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): static
    {
        $this->adress = $adress;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postal_code;
    }

    public function setPostalCode(string $postal_code): static
    {
        $this->postal_code = $postal_code;

        return $this;
    }

    public function getTown(): ?string
    {
        return $this->town;
    }

    public function setTown(string $town): static
    {
        $this->town = $town;

        return $this;
    }

    public function getImageName(): ?string
    {
        return $this->image_name;
    }

    public function setImageName(?string $image_name): static
    {
        $this->image_name = $image_name;

        return $this;
    }

    /**
     * @return Collection<int, VisitorTeam>
     */
    public function getVisitorTeams(): Collection
    {
        return $this->visitorTeams;
    }

    public function addVisitorTeam(VisitorTeam $visitorTeam): static
    {
        if (!$this->visitorTeams->contains($visitorTeam)) {
            $this->visitorTeams->add($visitorTeam);
            $visitorTeam->setClub($this);
        }

        return $this;
    }

    public function removeVisitorTeam(VisitorTeam $visitorTeam): static
    {
        if ($this->visitorTeams->removeElement($visitorTeam)) {
            // set the owning side to null (unless already changed)
            if ($visitorTeam->getClub() === $this) {
                $visitorTeam->setClub(null);
            }
        }

        return $this;
    }
}
