<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CastingRepository")
 */
class Casting
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
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Film", mappedBy="acteurs")
     */
    private $filmsInterpretes;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Film", mappedBy="realisateurs")
     */
    private $filmsRealises;

    public function __construct()
    {
        $this->filmsInterpretes = new ArrayCollection();
        $this->filmsRealises = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection|Film[]
     */
    public function getFilmsInterpretes(): Collection
    {
        return $this->filmsInterpretes;
    }

    public function addFilmsInterprete(Film $filmsInterprete): self
    {
        if (!$this->filmsInterpretes->contains($filmsInterprete)) {
            $this->filmsInterpretes[] = $filmsInterprete;
            $filmsInterprete->addActeur($this);
        }

        return $this;
    }

    public function removeFilmsInterprete(Film $filmsInterprete): self
    {
        if ($this->filmsInterpretes->contains($filmsInterprete)) {
            $this->filmsInterpretes->removeElement($filmsInterprete);
            $filmsInterprete->removeActeur($this);
        }

        return $this;
    }

    /**
     * @return Collection|Film[]
     */
    public function getFilmsRealises(): Collection
    {
        return $this->filmsRealises;
    }

    public function addFilmsRealise(Film $filmsRealise): self
    {
        if (!$this->filmsRealises->contains($filmsRealise)) {
            $this->filmsRealises[] = $filmsRealise;
            $filmsRealise->addRealisateur($this);
        }

        return $this;
    }

    public function removeFilmsRealise(Film $filmsRealise): self
    {
        if ($this->filmsRealises->contains($filmsRealise)) {
            $this->filmsRealises->removeElement($filmsRealise);
            $filmsRealise->removeRealisateur($this);
        }

        return $this;
    }
}
