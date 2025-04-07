<?php
// src/Entity/Session.php
namespace App\Entity;

use App\Repository\SessionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SessionRepository::class)]
class Session
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type:"integer")]
    private ?int $id = null;

    #[ORM\Column(type:"datetime")]
    private ?\DateTimeInterface $dateDebut = null;

    #[ORM\Column(type:"datetime")]
    private ?\DateTimeInterface $dateFin = null;

    #[ORM\Column(type:"float")]
    private ?float $coutTotal = null;

    #[ORM\ManyToOne(targetEntity: Project::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Project $project = null;

    public function getId(): ?int { return $this->id; }
    public function getDateDebut(): ?\DateTimeInterface { return $this->dateDebut; }
    public function setDateDebut(\DateTimeInterface $dateDebut): self { $this->dateDebut = $dateDebut; return $this; }
    public function getDateFin(): ?\DateTimeInterface { return $this->dateFin; }
    public function setDateFin(\DateTimeInterface $dateFin): self { $this->dateFin = $dateFin; return $this; }
    public function getCoutTotal(): ?float { return $this->coutTotal; }
    public function setCoutTotal(float $coutTotal): self { $this->coutTotal = $coutTotal; return $this; }
    public function getProject(): ?Project { return $this->project; }
    public function setProject(?Project $project): self { $this->project = $project; return $this; }
}
