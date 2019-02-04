<?php

namespace App\Entity\Back;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Back\userRepository")
 */
class user
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
    private $pseudo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $rank;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $passWord;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(?string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function setRank(?string $rank): self
    {
        $this->rank = $rank;

        return $this;
    }

    public function getRank(): ?string
    {
        return $this->rank;
    }

    public function getPassWord(): ?string
    {
        return $this->passWord;
    }

    public function setPassWord(?string $passWord): self
    {
        $this->passWord = $passWord;

        return $this;
    }
}
