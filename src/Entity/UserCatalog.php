<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserCatalogRepository")
 */
class UserCatalog
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="userCatalogs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Disc", inversedBy="userCatalogs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $disc_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getDiscId(): ?Disc
    {
        return $this->disc_id;
    }

    public function setDiscId(?Disc $disc_id): self
    {
        $this->disc_id = $disc_id;

        return $this;
    }
}
