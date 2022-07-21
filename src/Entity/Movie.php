<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Movie
 *
 * @ORM\Table(name="movie")
 * @ORM\Entity(repositoryClass="App\Repository\MovieRepository")
 */
class Movie
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
     * @ORM\Column(name="title", type="string", length=50, nullable=true)
     */
    private $title;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_release", type="date", nullable=true)
     */
    private $dateRelease;

    /**
     * @var string|null
     *
     * @ORM\Column(name="resume", type="string", length=400, nullable=true)
     */
    private $resume;

    /**
     * @var int|null
     *
     * @ORM\Column(name="duree", type="integer", nullable=true)
     */
    private $duree;

    /**
     * @var string|null
     *
     * @ORM\Column(name="img", type="string", nullable=true)
     */
    private $img;

    /**
     * @var string|null
     *
     * @ORM\Column(name="trailer", type="string", nullable=true)
     */
    private $trailer;

    /**
     * @ORM\OneToMany(targetEntity="Categorize",cascade={"persist"}, mappedBy="idMovie")
     */
    private $categorize;

    /**
     * @ORM\OneToMany(targetEntity="Rate",cascade={"persist"}, mappedBy="idMovie")
     */
    private $rate;

    public function __construct(){
        $this->categorize = new ArrayCollection();
        $this->rate = new ArrayCollection();
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
        $categorize->setIdMovie($this);
    }

    
    /**
     * @return Collection|Rate[]
     */
    public function getRate(): Collection
    {
        return $this->rate;
    }

    public function addRate(Rate $rate)
    {
        $this->rate->add($rate);
        $rate->setIdMovie($this);
    }

    public function __toString():string
    {
        return $this->title;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDateRelease(): ?\DateTimeInterface
    {
        return $this->dateRelease;
    }

    public function setDateRelease(?\DateTimeInterface $dateRelease): self
    {
        $this->dateRelease = $dateRelease;

        return $this;
    }

    public function getResume(): ?string
    {
        return $this->resume;
    }

    public function setResume(?string $resume): self
    {
        $this->resume = $resume;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(?int $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(?string $img): self
    {
        $this->img = $img;

        return $this;
    }

    public function getTrailer(): ?string
    {
        return $this->trailer;
    }

    public function setTrailer(?string $trailer): self
    {
        $this->trailer = $trailer;

        return $this;
    }

}
