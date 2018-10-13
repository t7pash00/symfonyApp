<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AssignexamtostudentsRepository")
 */
class Assignexamtostudents
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $examid;

    /**
     * @ORM\Column(type="integer")
     */
    private $Studentid;

    /**
     * @ORM\Column(type="datetime")
     */
    private $assigndate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Startrange;

    /**
     * @ORM\Column(type="datetime")
     */
    private $endrange;

    /**
     * @ORM\Column(type="datetime")
     */
    private $selecteddate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $selectedtime;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isConfirmed;

    /**
     * @ORM\Column(type="integer")
     */
    private $results;

    /**
     * @ORM\Column(type="boolean")
     */
    private $showtostudents;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getExamid(): ?int
    {
        return $this->examid;
    }

    public function setExamid(int $examid): self
    {
        $this->examid = $examid;

        return $this;
    }

    public function getStudentid(): ?int
    {
        return $this->Studentid;
    }

    public function setStudentid(int $Studentid): self
    {
        $this->Studentid = $Studentid;

        return $this;
    }

    public function getAssigndate(): ?\DateTimeInterface
    {
        return $this->assigndate;
    }

    public function setAssigndate(\DateTimeInterface $assigndate): self
    {
        $this->assigndate = $assigndate;

        return $this;
    }

    public function getStartrange(): ?\DateTimeInterface
    {
        return $this->Startrange;
    }

    public function setStartrange(\DateTimeInterface $Startrange): self
    {
        $this->Startrange = $Startrange;

        return $this;
    }

    public function getEndrange(): ?\DateTimeInterface
    {
        return $this->endrange;
    }

    public function setEndrange(\DateTimeInterface $endrange): self
    {
        $this->endrange = $endrange;

        return $this;
    }

    public function getSelecteddate(): ?\DateTimeInterface
    {
        return $this->selecteddate;
    }

    public function setSelecteddate(\DateTimeInterface $selecteddate): self
    {
        $this->selecteddate = $selecteddate;

        return $this;
    }

    public function getSelectedtime(): ?\DateTimeInterface
    {
        return $this->selectedtime;
    }

    public function setSelectedtime(\DateTimeInterface $selectedtime): self
    {
        $this->selectedtime = $selectedtime;

        return $this;
    }

    public function getIsConfirmed(): ?bool
    {
        return $this->isConfirmed;
    }

    public function setIsConfirmed(bool $isConfirmed): self
    {
        $this->isConfirmed = $isConfirmed;

        return $this;
    }

    public function getResults(): ?int
    {
        return $this->results;
    }

    public function setResults(int $results): self
    {
        $this->results = $results;

        return $this;
    }

    public function getShowtostudents(): ?bool
    {
        return $this->showtostudents;
    }

    public function setShowtostudents(bool $showtostudents): self
    {
        $this->showtostudents = $showtostudents;

        return $this;
    }
}
