<?php

namespace App\Entity;

use App\Repository\EtudiantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\OneToMany(targetEntity: StageApprentissage::class, mappedBy: 'IdEtudiant', orphanRemoval: true)]
    private Collection $stageApprentissages;

    public function __construct()
    {
        $this->stageApprentissages = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, StageApprentissage>
     */
    public function getStageApprentissages(): Collection
    {
        return $this->stageApprentissages;
    }

    public function addStageApprentissage(StageApprentissage $stageApprentissage): static
    {
        if (!$this->stageApprentissages->contains($stageApprentissage)) {
            $this->stageApprentissages->add($stageApprentissage);
            $stageApprentissage->setIdEtudiant($this);
        }

        return $this;
    }

    public function removeStageApprentissage(StageApprentissage $stageApprentissage): static
    {
        if ($this->stageApprentissages->removeElement($stageApprentissage)) {
            // set the owning side to null (unless already changed)
            if ($stageApprentissage->getIdEtudiant() === $this) {
                $stageApprentissage->setIdEtudiant(null);
            }
        }

        return $this;
    }
}
