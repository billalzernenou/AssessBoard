<?php

namespace App\Entity\Front;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Front\questionnaireRepository")
 */
class questionnaire
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
     * @ORM\Column(type="string", length=255)
     */
    private $description;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $promo;

    /**
     * @ORM\Column(type="integer")
     */
    private $year;

    /**
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Front\composantes", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
     private $composant;

    /**
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Front\UE", mappedBy="questionnaire", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
     private $ues;

    /**
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Front\sessions", mappedBy="questionnaire", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
     private $sessions;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ues = new ArrayCollection();
        $this->sessions = new ArrayCollection();
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


    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }


    public function getPromo(): ?string
    {
        return $this->promo;
    }

    public function setPromo(string $promo): self
    {
        $this->promo = $promo;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getComposant(): ?composantes
    {
        return $this->composant;
    }

    public function setComposant(?composantes $composant): self
    {
        $this->composant = $composant;

        return $this;
    }

    public function addUE(UE $ue)
    {
        $ue->setQuestionnaire($this);
        $this->ues[] = $ue;

        return $this;
    }

    public function removeUE(UE $ue)
    {
        $this->ues->removeElement($ue);
    }

    public function getUES()
    {
        return $this->ues;
    }

    public function addSession(sessions $session)
    {
        $session->setQuestionnaire($this);
        $this->sessions[] = $session;

        return $this;
    }

    public function removeSession(sessions $session)
    {
        $this->sessions->removeElement($session);
    }

    public function getSessions()
    {
        return $this->sessions;
    }

    public function __toString() {
        return $this->getPromo();
    }

}
