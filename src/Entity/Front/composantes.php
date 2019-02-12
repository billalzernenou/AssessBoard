<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Front\composantesRepository")
 */
class composantes
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
   *
   * @ORM\ManyToOne(targetEntity="App\Entity\Front\etablissements", cascade={"persist"})
   * @ORM\JoinColumn(nullable=false)
   */
   private $etablisseent ;

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

    public function getEtablisseent(): ?etablissements
    {
        return $this->etablisseent;
    }

    public function setEtablisseent(?etablissements $etablisseent): self
    {
        $this->etablisseent = $etablisseent;

        return $this;
    }

    public function __toString() {
        return $this->getName();
    }
}
