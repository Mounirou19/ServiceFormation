<?php
// src/Entity/Client.php
namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type:"integer")]
    private ?int $id = null;

    #[ORM\Column(type:"string", length:14, unique:true)]
    private ?string $siren = null;

    #[ORM\Column(type:"string", length:34)]
    private ?string $iban = null;

    #[ORM\Column(type:"string", length:255)]
    private ?string $adresse = null;

    #[ORM\Column(type:"string", length:255)]
    private ?string $contactFacturation = null;

    #[ORM\Column(type:"float")]
    private ?float $commission = null;

    public function getId(): ?int { return $this->id; }
    public function getSiren(): ?string { return $this->siren; }
    public function setSiren(string $siren): self { $this->siren = $siren; return $this; }
    public function getIban(): ?string { return $this->iban; }
    public function setIban(string $iban): self { $this->iban = $iban; return $this; }
    public function getAdresse(): ?string { return $this->adresse; }
    public function setAdresse(string $adresse): self { $this->adresse = $adresse; return $this; }
    public function getContactFacturation(): ?string { return $this->contactFacturation; }
    public function setContactFacturation(string $contactFacturation): self { $this->contactFacturation = $contactFacturation; return $this; }
    public function getCommission(): ?float { return $this->commission; }
    public function setCommission(float $commission): self { $this->commission = $commission; return $this; }
}
