<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FabricantRepository")
 */
class Fabricant
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
    private $Nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $PaysOrigine;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Appareil", inversedBy="IdFab")
     */
    private $appareil;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPaysOrigine(): ?string
    {
        return $this->PaysOrigine;
    }

    public function setPaysOrigine(string $PaysOrigine): self
    {
        $this->PaysOrigine = $PaysOrigine;

        return $this;
    }

    public function getAppareil(): ?Appareil
    {
        return $this->appareil;
    }

    public function setAppareil(?Appareil $appareil): self
    {
        $this->appareil = $appareil;

        return $this;
    }
}
