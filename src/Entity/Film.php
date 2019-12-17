<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FilmRepository")
 */
class Film
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
    private $titre;

    /**
     * @ORM\Column(type="integer")
     */
    private $duree;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Lien", mappedBy="film")
     */
    private $liens;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Pays", inversedBy="films")
     */
    private $pays;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Genre", inversedBy="films")
     * @ORM\JoinColumn(nullable=false)
     */
    private $genre;

    /**
     * @ORM\JoinTable(name="acteurs_films")
     * @ORM\ManyToMany(targetEntity="App\Entity\Casting", inversedBy="filmsInterpretes")
     */
    private $acteurs;

    /**
     * @ORM\JoinTable(name="realisateurs_films")
     * @ORM\ManyToMany(targetEntity="App\Entity\Casting", inversedBy="filmsRealises")
     */
    private $realisateurs;

    public function __construct()
    {
        $this->liens = new ArrayCollection();
        $this->pays = new ArrayCollection();
        $this->acteurs = new ArrayCollection();
        $this->realisateurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(int $duree): self
    {
        $this->duree = $duree;

        return $this + "minutes :";
    }

    /**
     * @return Collection|Lien[]
     */
    public function getLiens(): Collection
    {
        return $this->liens;
    }

    public function addLien(Lien $lien): self
    {
        if (!$this->liens->contains($lien)) {
            $this->liens[] = $lien;
            $lien->setFilm($this);
        }

        return $this;
    }

    public function removeLien(Lien $lien): self
    {
        if ($this->liens->contains($lien)) {
            $this->liens->removeElement($lien);
            // set the owning side to null (unless already changed)
            if ($lien->getFilm() === $this) {
                $lien->setFilm(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Pays[]
     */
    public function getPays(): Collection
    {
        return $this->pays;
    }

    public function addPay(Pays $pay): self
    {
        if (!$this->pays->contains($pay)) {
            $this->pays[] = $pay;
        }

        return $this;
    }

    public function removePay(Pays $pay): self
    {
        if ($this->pays->contains($pay)) {
            $this->pays->removeElement($pay);
        }

        return $this;
    }

    public function getGenre(): ?Genre
    {
        return $this->genre;
    }

    public function setGenre(?Genre $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * @return Collection|Casting[]
     */
    public function getActeurs(): Collection
    {
        return $this->acteurs;
    }

    public function addActeur(Casting $acteur): self
    {
        if (!$this->acteurs->contains($acteur)) {
            $this->acteurs[] = $acteur;
        }

        return $this;
    }

    public function removeActeur(Casting $acteur): self
    {
        if ($this->acteurs->contains($acteur)) {
            $this->acteurs->removeElement($acteur);
        }

        return $this;
    }

    /**
     * @return Collection|Casting[]
     */
    public function getRealisateurs(): Collection
    {
        return $this->realisateurs;
    }

    public function addRealisateur(Casting $realisateur): self
    {
        if (!$this->realisateurs->contains($realisateur)) {
            $this->realisateurs[] = $realisateur;
        }

        return $this;
    }

    public function removeRealisateur(Casting $realisateur): self
    {
        if ($this->realisateurs->contains($realisateur)) {
            $this->realisateurs->removeElement($realisateur);
        }

        return $this;
    }
}
