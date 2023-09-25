<?php

namespace App\Entity;

use App\Repository\SchedulesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SchedulesRepository::class)]
class Schedules
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'schedules')]
    private ?Inspectors $inspector = null;

    #[ORM\ManyToOne(inversedBy: 'schedules')]
    private ?Jobs $job = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column]
    private ?bool $completed = null;

    #[ORM\OneToMany(mappedBy: 'schedule', targetEntity: Assessments::class)]
    private Collection $assessments;

    public function __construct()
    {
        $this->assessments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInspector(): ?Inspectors
    {
        return $this->inspector;
    }

    public function setInspector(?Inspectors $inspector): static
    {
        $this->inspector = $inspector;

        return $this;
    }

    public function getJob(): ?Jobs
    {
        return $this->job;
    }

    public function setJob(?Jobs $job): static
    {
        $this->job = $job;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function isCompleted(): ?bool
    {
        return $this->completed;
    }

    public function setCompleted(bool $completed): static
    {
        $this->completed = $completed;

        return $this;
    }

    /**
     * @return Collection<int, Assessments>
     */
    public function getAssessments(): Collection
    {
        return $this->assessments;
    }

    public function addAssessment(Assessments $assessment): static
    {
        if (!$this->assessments->contains($assessment)) {
            $this->assessments->add($assessment);
            $assessment->setSchedule($this);
        }

        return $this;
    }

    public function removeAssessment(Assessments $assessment): static
    {
        if ($this->assessments->removeElement($assessment)) {
            // set the owning side to null (unless already changed)
            if ($assessment->getSchedule() === $this) {
                $assessment->setSchedule(null);
            }
        }

        return $this;
    }
}
