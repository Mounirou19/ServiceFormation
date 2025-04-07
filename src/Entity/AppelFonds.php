<?php
// src/Entity/AppelFonds.php
namespace App\Entity;

use App\Repository\AppelFondsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AppelFondsRepository::class)]
class AppelFonds
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type:"integer")]
    private ?int $id = null;

    #[ORM\Column(type:"datetime")]
    private ?\DateTimeInterface $dateAppel = null;

    #[ORM\Column(type:"float")]
    private ?float $montant = null;

    #[ORM\ManyToOne(targetEntity: Project::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Project $project = null;

    public function getId(): ?int { return $this->id; }
    public function getDateAppel(): ?\DateTimeInterface { return $this->dateAppel; }
    public function setDateAppel(\DateTimeInterface $dateAppel): self { $this->dateAppel = $dateAppel; return $this; }
    public function getMontant(): ?float { return $this->montant; }
    public function setMontant(float $montant): self { $this->montant = $montant; return $this; }
    public function getProject(): ?Project { return $this->project; }
    public function setProject(?Project $project): self { $this->project = $project; return $this; }
}
