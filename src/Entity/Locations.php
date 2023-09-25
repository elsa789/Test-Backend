<?php

namespace App\Entity;

use App\Repository\LocationsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LocationsRepository::class)]
class Locations
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'location', targetEntity: Inspectors::class)]
    private Collection $inspectors;

    public function __construct()
    {
        $this->inspectors = new ArrayCollection();
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

    /**
     * @return Collection<int, Inspectors>
     */
    public function getInspectors(): Collection
    {
        return $this->inspectors;
    }

    public function addInspector(Inspectors $inspector): static
    {
        if (!$this->inspectors->contains($inspector)) {
            $this->inspectors->add($inspector);
            $inspector->setLocation($this);
        }

        return $this;
    }

    public function removeInspector(Inspectors $inspector): static
    {
        if ($this->inspectors->removeElement($inspector)) {
            // set the owning side to null (unless already changed)
            if ($inspector->getLocation() === $this) {
                $inspector->setLocation(null);
            }
        }

        return $this;
    }
}
