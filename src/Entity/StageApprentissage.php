<?php

namespace App\Entity;

use App\Repository\StageApprentissageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StageApprentissageRepository::class)]
class StageApprentissage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $DateDebut = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $DateFin = null;

    #[ORM\ManyToOne(inversedBy: 'stageApprentissages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Etudiant $IdEtudiant = null;

    #[ORM\ManyToOne(inversedBy: 'stageApprentissage')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Entreprise $IdEntreprise = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->DateDebut;
    }

    public function setDateDebut(\DateTimeInterface $DateDebut): static
    {
        $this->DateDebut = $DateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->DateFin;
    }

    public function setDateFin(\DateTimeInterface $DateFin): static
    {
        $this->DateFin = $DateFin;

        return $this;
    }

    public function getIdEtudiant(): ?Etudiant
    {
        return $this->IdEtudiant;
    }

    public function setIdEtudiant(?Etudiant $IdEtudiant): static
    {
        $this->IdEtudiant = $IdEtudiant;

        return $this;
    }

    public function getIdEntreprise(): ?Entreprise
    {
        return $this->IdEntreprise;
    }

    public function setIdEntreprise(?Entreprise $IdEntreprise): static
    {
        $this->IdEntreprise = $IdEntreprise;

        return $this;
    }
}
