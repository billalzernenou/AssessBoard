<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Front\answersRepository")
 */
class answers
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
    private $mark;

    /**
   *
   * @ORM\ManyToOne(targetEntity="App\Entity\Front\UE", cascade={"persist"})
   * @ORM\JoinColumn(nullable=false)
   */
   private $UE ;

    /**
    *
    * @ORM\ManyToOne(targetEntity="App\Entity\Front\sessions", cascade={"persist"})
    * @ORM\JoinColumn(nullable=false)
    */
    private $sessions ;

   /**
   *
   * @ORM\ManyToOne(targetEntity="App\Entity\Front\questionType", cascade={"persist"})
   * @ORM\JoinColumn(nullable=false)
   */
   private $questionType ;
  

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMark(): ?string
    {
        return $this->mark;
    }

    public function setMark(?string $mark): self
    {
        $this->mark = $mark;

        return $this;
    }


    public function getUE(): ?UE
    {
        return $this->UE;
    }

    public function setUE(?UE $UE): self
    {
        $this->UE = $UE;

        return $this;
    }

    public function getSessions(): ?sessions
    {
        return $this->sessions;
    }

    public function setSessions(?session $sessions): self
    {
        $this->sessions = $sessions;

        return $this;
    }

    public function getQuestionType(): ?questionType
    {
        return $this->questionType;
    }

    public function setQuestionType(?questionType $questionType): self
    {
        $this->questionType = $questionType;

        return $this;
    }

}
