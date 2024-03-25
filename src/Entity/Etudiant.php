<?php

namespace App\Entity;

use App\Repository\EtudiantRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtudiantRepository::class)]
class Etudiant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $NomEleve = null;

    #[ORM\Column(length: 50)]
    private ?string $PrenomEtudiant = null;

    #[ORM\ManyToOne(inversedBy: 'etudiants')]
    private ?Etude $IdEtude = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEleve(): ?string
    {
        return $this->NomEleve;
    }

    public function setNomEleve(string $NomEleve): static
    {
        $this->NomEleve = $NomEleve;

        return $this;
    }

    public function getPrenomEtudiant(): ?string
    {
        return $this->PrenomEtudiant;
    }

    public function setPrenomEtudiant(string $PrenomEtudiant): static
    {
        $this->PrenomEtudiant = $PrenomEtudiant;

        return $this;
    }

    public function getIdEtude(): ?Etude
    {
        return $this->IdEtude;
    }

    public function setIdEtude(?Etude $IdEtude): static
    {
        $this->IdEtude = $IdEtude;

        return $this;
    }
}
