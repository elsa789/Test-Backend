<?php

namespace App\Entity;

use App\Repository\InspectorsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InspectorsRepository::class)]
class Inspectors
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'inspectors')]
    public ?Locations $location = null;

    #[ORM\OneToMany(mappedBy: 'inspector', targetEntity: Schedules::class)]
    private Collection $schedules;

    public function __construct()
    {
        $this->schedules = new ArrayCollection();
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

    public function getLocation(): ?Locations
    {
        return $this->location;
    }

    public function setLocation(?Locations $location): static
    {
        $this->location = $location;

        return $this;
    }

    /**
     * @return Collection<int, Schedules>
     */
    public function getSchedules(): Collection
    {
        return $this->schedules;
    }

    public function addSchedule(Schedules $schedule): static
    {
        if (!$this->schedules->contains($schedule)) {
            $this->schedules->add($schedule);
            $schedule->setInspector($this);
        }

        return $this;
    }

    public function removeSchedule(Schedules $schedule): static
    {
        if ($this->schedules->removeElement($schedule)) {
            // set the owning side to null (unless already changed)
            if ($schedule->getInspector() === $this) {
                $schedule->setInspector(null);
            }
        }

        return $this;
    }
}
