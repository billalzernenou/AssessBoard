<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Front\UERepository")
 */
class UE
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $hasTDTP;

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

    public function getHasTDTP(): ?bool
    {
        return $this->hasTDTP;
    }

    public function setHasTDTP(?bool $hasTDTP): self
    {
        $this->hasTDTP = $hasTDTP;

        return $this;
    }
}
