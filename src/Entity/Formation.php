<?php
// src/Entity/Formation.php
namespace App\Entity;

use App\Repository\FormationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormationRepository::class)]
class Formation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type:"integer")]
    private ?int $id = null;

    #[ORM\Column(type:"string", length:255)]
    private ?string $organisme = null;

    #[ORM\Column(type:"float")]
    private ?float $coutHT = null;

    #[ORM\Column(type:"float")]
    private ?float $tva = null;

    #[ORM\Column(type:"datetime")]
    private ?\DateTimeInterface $dateFormation = null;

    #[ORM\ManyToOne(targetEntity: Session::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Session $session = null;

    public function getId(): ?int { return $this->id; }
    public function getOrganisme(): ?string { return $this->organisme; }
    public function setOrganisme(string $organisme): self { $this->organisme = $organisme; return $this; }
    public function getCoutHT(): ?float { return $this->coutHT; }
    public function setCoutHT(float $coutHT): self { $this->coutHT = $coutHT; return $this; }
    public function getTva(): ?float { return $this->tva; }
    public function setTva(float $tva): self { $this->tva = $tva; return $this; }
    public function getDateFormation(): ?\DateTimeInterface { return $this->dateFormation; }
    public function setDateFormation(\DateTimeInterface $dateFormation): self { $this->dateFormation = $dateFormation; return $this; }
    public function getSession(): ?Session { return $this->session; }
    public function setSession(?Session $session): self { $this->session = $session; return $this; }
}
