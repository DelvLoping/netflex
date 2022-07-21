<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categorize
 *
 * @ORM\Table(name="categorize", indexes={@ORM\Index(name="id_genre", columns={"id_genre"}), @ORM\Index(name="id_movie", columns={"id_movie"})})
 * @ORM\Entity(repositoryClass="App\Repository\CategorizeRepository")
 */
class Categorize
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Genre
     *
     * @ORM\ManyToOne(targetEntity="Genre", inversedBy="categorize")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_genre", referencedColumnName="id")
     * })
     */
    private $idGenre;

    /**
     * @var \Movie
     *
     * @ORM\ManyToOne(targetEntity="Movie", inversedBy="categorize")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_movie", referencedColumnName="id")
     * })
     */
    private $idMovie;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdGenre(): ?Genre
    {
        return $this->idGenre;
    }

    public function setIdGenre(?Genre $idGenre): self
    {
        $this->idGenre = $idGenre;

        return $this;
    }

    public function getIdMovie(): ?Movie
    {
        return $this->idMovie;
    }

    public function setIdMovie(?Movie $idMovie): self
    {
        $this->idMovie = $idMovie;

        return $this;
    }


}
