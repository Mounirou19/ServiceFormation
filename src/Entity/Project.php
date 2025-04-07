<?php
// src/Entity/Project.php
namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type:"integer")]
    private ?int $id = null;

    #[ORM\Column(type:"string", length:255)]
    private ?string $name = null;

    #[ORM\Column(type:"float")]
    private ?float $budgetInitial = null;

    #[ORM\Column(type:"float")]
    private ?float $seuilAlerte = null;

    #[ORM\Column(type:"json")]
    private array $listeDiffusion = [];

    #[ORM\ManyToOne(targetEntity: Client::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Client $client = null;

    public function getId(): ?int { return $this->id; }
    public function getName(): ?string { return $this->name; }
    public function setName(string $name): self { $this->name = $name; return $this; }
    public function getBudgetInitial(): ?float { return $this->budgetInitial; }
    public function setBudgetInitial(float $budgetInitial): self { $this->budgetInitial = $budgetInitial; return $this; }
    public function getSeuilAlerte(): ?float { return $this->seuilAlerte; }
    public function setSeuilAlerte(float $seuilAlerte): self { $this->seuilAlerte = $seuilAlerte; return $this; }
    public function getListeDiffusion(): array { return $this->listeDiffusion; }
    public function setListeDiffusion(array $listeDiffusion): self { $this->listeDiffusion = $listeDiffusion; return $this; }
    public function getClient(): ?Client { return $this->client; }
    public function setClient(?Client $client): self { $this->client = $client; return $this; }
}
