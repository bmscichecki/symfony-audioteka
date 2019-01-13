<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GenreRepository")
 */
class Genre
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
    private $genre_name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Disc", mappedBy="genre_id")
     */
    private $discs;

    public function __construct()
    {
        $this->discs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGenreName(): ?string
    {
        return $this->genre_name;
    }

    public function setGenreName(string $genre_name): self
    {
        $this->genre_name = $genre_name;

        return $this;
    }

    /**
     * @return Collection|Disc[]
     */
    public function getDiscs(): Collection
    {
        return $this->discs;
    }

    public function addDisc(Disc $disc): self
    {
        if (!$this->discs->contains($disc)) {
            $this->discs[] = $disc;
            $disc->setGenreId($this);
        }

        return $this;
    }

    public function removeDisc(Disc $disc): self
    {
        if ($this->discs->contains($disc)) {
            $this->discs->removeElement($disc);
            // set the owning side to null (unless already changed)
            if ($disc->getGenreId() === $this) {
                $disc->setGenreId(null);
            }
        }

        return $this;
    }
}
