<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AppareilRepository")
 */
class Appareil
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Designation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Type;

    /**
     * @ORM\Column(type="integer")
     */
    private $PrixUnit;

    /**
     * @ORM\Column(type="integer")
     */
    private $QteVendue;

    /**
     * @ORM\Column(type="date")
     */
    private $DateSortie;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Systeme", mappedBy="appareil")
     */
    private $IdOS;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Fabricant", mappedBy="appareil")
     */
    private $IdFab;

    public function __construct()
    {
        $this->IdOS = new ArrayCollection();
        $this->IdFab = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignation(): ?string
    {
        return $this->Designation;
    }

    public function setDesignation(string $Designation): self
    {
        $this->Designation = $Designation;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->Type;
    }

    public function setType(string $Type): self
    {
        $this->Type = $Type;

        return $this;
    }

    public function getPrixUnit(): ?int
    {
        return $this->PrixUnit;
    }

    public function setPrixUnit(int $PrixUnit): self
    {
        $this->PrixUnit = $PrixUnit;

        return $this;
    }

    public function getQteVendue(): ?int
    {
        return $this->QteVendue;
    }

    public function setQteVendue(int $QteVendue): self
    {
        $this->QteVendue = $QteVendue;

        return $this;
    }

    public function getDateSortie(): ?\DateTimeInterface
    {
        return $this->DateSortie;
    }

    public function setDateSortie(\DateTimeInterface $DateSortie): self
    {
        $this->DateSortie = $DateSortie;

        return $this;
    }

    /**
     * @return Collection|Systeme[]
     */
    public function getIdOS(): Collection
    {
        return $this->IdOS;
    }

    public function addIdO(Systeme $idO): self
    {
        if (!$this->IdOS->contains($idO)) {
            $this->IdOS[] = $idO;
            $idO->setAppareil($this);
        }

        return $this;
    }

    public function removeIdO(Systeme $idO): self
    {
        if ($this->IdOS->contains($idO)) {
            $this->IdOS->removeElement($idO);
            // set the owning side to null (unless already changed)
            if ($idO->getAppareil() === $this) {
                $idO->setAppareil(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Fabricant[]
     */
    public function getIdFab(): Collection
    {
        return $this->IdFab;
    }

    public function addIdFab(Fabricant $idFab): self
    {
        if (!$this->IdFab->contains($idFab)) {
            $this->IdFab[] = $idFab;
            $idFab->setAppareil($this);
        }

        return $this;
    }

    public function removeIdFab(Fabricant $idFab): self
    {
        if ($this->IdFab->contains($idFab)) {
            $this->IdFab->removeElement($idFab);
            // set the owning side to null (unless already changed)
            if ($idFab->getAppareil() === $this) {
                $idFab->setAppareil(null);
            }
        }

        return $this;
    }
}
