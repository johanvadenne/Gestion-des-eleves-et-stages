<?php

namespace App\Entity;

use App\Repository\EntrepriseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntrepriseRepository::class)]
class Entreprise
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $NomEntreprise = null;

    #[ORM\Column(length: 255)]
    private ?string $Mail = null;

    #[ORM\Column(length: 255)]
    private ?string $Adresse = null;

    #[ORM\Column(length: 255)]
    private ?string $Ville = null;

    #[ORM\Column(length: 255)]
    private ?string $SiteWeb = null;

    #[ORM\OneToMany(targetEntity: StageApprentissage::class, mappedBy: 'IdEntreprise', orphanRemoval: true)]
    private Collection $stageApprentissage;

    public function __construct()
    {
        $this->stageApprentissage = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEntreprise(): ?string
    {
        return $this->NomEntreprise;
    }

    public function setNomEntreprise(string $NomEntreprise): static
    {
        $this->NomEntreprise = $NomEntreprise;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->Mail;
    }

    public function setMail(string $Mail): static
    {
        $this->Mail = $Mail;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->Adresse;
    }

    public function setAdresse(string $Adresse): static
    {
        $this->Adresse = $Adresse;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->Ville;
    }

    public function setVille(string $Ville): static
    {
        $this->Ville = $Ville;

        return $this;
    }

    public function getSiteWeb(): ?string
    {
        return $this->SiteWeb;
    }

    public function setSiteWeb(string $SiteWeb): static
    {
        $this->SiteWeb = $SiteWeb;

        return $this;
    }

    /**
     * @return Collection<int, StageApprentissage>
     */
    public function getStageApprentissage(): Collection
    {
        return $this->stageApprentissage;
    }

    public function addStageApprentissage(StageApprentissage $stageApprentissage): static
    {
        if (!$this->stageApprentissage->contains($stageApprentissage)) {
            $this->stageApprentissage->add($stageApprentissage);
            $stageApprentissage->setIdEntreprise($this);
        }

        return $this;
    }

    public function removeStageApprentissage(StageApprentissage $stageApprentissage): static
    {
        if ($this->stageApprentissage->removeElement($stageApprentissage)) {
            // set the owning side to null (unless already changed)
            if ($stageApprentissage->getIdEntreprise() === $this) {
                $stageApprentissage->setIdEntreprise(null);
            }
        }

        return $this;
    }
}
