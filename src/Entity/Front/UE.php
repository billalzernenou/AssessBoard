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

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $hasLessons;

  /**
   *
   * @ORM\ManyToOne(targetEntity="App\Entity\Front\questionnaire", cascade={"persist"})
   * @ORM\JoinColumn(nullable=false)
   */
   private $questionnaire;

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

    public function getHasLessons(): ?bool
    {
        return $this->hasLessons;
    }

    public function setHasLessons(?bool $hasLessons): self
    {
        $this->hasLessons = $hasLessons;

        return $this;
    }

    public function getQuestionnaire(): ?questionnaire
    {
        return $this->questionnaire;
    }

    public function setQuestionnaire(?questionnaire $questionnaire): self
    {
        $this->questionnaire = $questionnaire;

        return $this;
    }


}
