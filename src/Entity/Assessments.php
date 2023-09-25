<?php

namespace App\Entity;

use App\Repository\AssessmentsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AssessmentsRepository::class)]
class Assessments
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'assessments')]
    private ?Schedules $schedule = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $comments = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSchedule(): ?Schedules
    {
        return $this->schedule;
    }

    public function setSchedule(?Schedules $schedule): static
    {
        $this->schedule = $schedule;

        return $this;
    }

    public function getComments(): ?string
    {
        return $this->comments;
    }

    public function setComments(string $comments): static
    {
        $this->comments = $comments;

        return $this;
    }
}
