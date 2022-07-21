<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FilmCrew
 *
 * @ORM\Table(name="film_crew", indexes={@ORM\Index(name="id_contributor", columns={"id_contributor"}), @ORM\Index(name="id_job", columns={"id_job"}), @ORM\Index(name="id_movie", columns={"id_movie"})})
 * @ORM\Entity(repositoryClass="App\Repository\FilmCrewRepository")
 */
class FilmCrew
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
     * @var int|null
     *
     * @ORM\ManyToOne(targetEntity="Job")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_job", referencedColumnName="id")
     * })
     */
    private $idJob;

    /**
     * @var \Contributor
     *
     * @ORM\ManyToOne(targetEntity="Contributor")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_contributor", referencedColumnName="id")
     * })
     */
    private $idContributor;

    /**
     * @var \Movie
     *
     * @ORM\ManyToOne(targetEntity="Movie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_movie", referencedColumnName="id")
     * })
     */
    private $idMovie;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdJob(): ?Job
    {
        return $this->idJob;
    }

    public function setIdJob(?Job $idJob): self
    {
        $this->idJob = $idJob;

        return $this;
    }

    public function getIdContributor(): ?Contributor
    {
        return $this->idContributor;
    }

    public function setIdContributor(?Contributor $idContributor): self
    {
        $this->idContributor = $idContributor;

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
