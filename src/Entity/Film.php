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

    public function __construct()
    {
        $this->liens = new ArrayCollection();
        $this->pays = new ArrayCollection();
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

        return $this;
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
}
