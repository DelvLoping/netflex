<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Seen
 *
 * @ORM\Table(name="seen", indexes={@ORM\Index(name="id_movie", columns={"id_movie"}), @ORM\Index(name="id_users", columns={"id_users"})})
 * @ORM\Entity(repositoryClass="App\Repository\SeenRepository")
 */
class Seen
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
     * @var \Movie
     *
     * @ORM\ManyToOne(targetEntity="Movie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_movie", referencedColumnName="id")
     * })
     */
    private $idMovie;

    /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="Users", inversedBy="seen")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_users", referencedColumnName="id")
     * })
     */
    private $idUsers;


    public function getId(): ?int
    {
        return $this->id;
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

    public function getIdUsers(): ?Users
    {
        return $this->idUsers;
    }

    public function setIdUsers(?Users $idUsers): self
    {
        $this->idUsers = $idUsers;

        return $this;
    }


}
