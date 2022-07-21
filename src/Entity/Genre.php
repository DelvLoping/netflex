<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Genre
 *
 * @ORM\Table(name="genre")
 * @ORM\Entity(repositoryClass="App\Repository\GenreRepository")
 */
class Genre
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
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=true)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Categorize",cascade={"persist"}, mappedBy="idGenre")
     */
    private $categorize;

    public function __construct(){
        $this->categorize = new ArrayCollection();
    }

    /**
     * @return Collection|Categorize[]
     */
    public function getCategorize(): Collection
    {
        return $this->categorize;
    }

    public function addCategorize(Categorize $categorize)
    {
        $this->categorize->add($categorize);
        $categorize->setIdGenre($this);
    }

    public function __toString():string
    {
        return $this->name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
