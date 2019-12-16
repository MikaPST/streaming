<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EpisodeRepository")
 */
class Episode
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $numEpisode;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Saison", inversedBy="episodes")
     */
    private $saison;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumEpisode(): ?int
    {
        return $this->numEpisode;
    }

    public function setNumEpisode(int $numEpisode): self
    {
        $this->numEpisode = $numEpisode;

        return $this;
    }

    public function getSaison(): ?Saison
    {
        return $this->saison;
    }

    public function setSaison(?Saison $saison): self
    {
        $this->saison = $saison;

        return $this;
    }
}
