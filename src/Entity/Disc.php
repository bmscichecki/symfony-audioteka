<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DiscRepository")
 */
class Disc
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
    private $title;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Genre", inversedBy="discs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $genre_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Author", inversedBy="discs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $author_id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserCatalog", mappedBy="disc_id", orphanRemoval=true)
     */
    private $userCatalogs;

    public function __construct()
    {
        $this->userCatalogs = new ArrayCollection();
    }




    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getGenreId(): ?Genre
    {
        return $this->genre_id;
    }

    public function setGenreId(?Genre $genre_id): self
    {
        $this->genre_id = $genre_id;

        return $this;
    }

    public function getAuthorId(): ?Author
    {
        return $this->author_id;
    }

    public function setAuthorId(?Author $author_id): self
    {
        $this->author_id = $author_id;

        return $this;
    }

    /**
     * @return Collection|UserCatalog[]
     */
    public function getUserCatalogs(): Collection
    {
        return $this->userCatalogs;
    }

    public function addUserCatalog(UserCatalog $userCatalog): self
    {
        if (!$this->userCatalogs->contains($userCatalog)) {
            $this->userCatalogs[] = $userCatalog;
            $userCatalog->setDiscId($this);
        }

        return $this;
    }

    public function removeUserCatalog(UserCatalog $userCatalog): self
    {
        if ($this->userCatalogs->contains($userCatalog)) {
            $this->userCatalogs->removeElement($userCatalog);
            // set the owning side to null (unless already changed)
            if ($userCatalog->getDiscId() === $this) {
                $userCatalog->setDiscId(null);
            }
        }

        return $this;
    }


}
