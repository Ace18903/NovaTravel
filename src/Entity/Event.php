<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\Collection;
use App\Entity\PlanningEvents;

#[ORM\Entity]
class Event
{

    #[ORM\Id]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "string", length: 100)]
    private string $nom;

    #[ORM\Column(type: "text")]
    private string $description;

    #[ORM\Column(type: "string", length: 100)]
    private string $lieu;

    #[ORM\Column(type: "string", length: 255)]
    private string $dateEvent;

    public function getDateEvent()
    {
        return $this->dateEvent;
    }

    public function setDateEvent($value)
    {
        $this->dateEvent = $value;
    }


    #[ORM\Column(type: "integer")]
    private int $duree;

    #[ORM\Column(type: "float")]
    private float $prix;

    public function getId()
    {
        return $this->id;
    }

    public function setId($value)
    {
        $this->id = $value;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($value)
    {
        $this->nom = $value;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($value)
    {
        $this->description = $value;
    }

    public function getLieu()
    {
        return $this->lieu;
    }

    public function setLieu($value)
    {
        $this->lieu = $value;
    }

    

    public function getDuree()
    {
        return $this->duree;
    }

    public function setDuree($value)
    {
        $this->duree = $value;
    }

    public function getPrix()
    {
        return $this->prix;
    }

    public function setPrix($value)
    {
        $this->prix = $value;
    }

    #[ORM\OneToMany(mappedBy: "id_event", targetEntity: PlanningEvents::class)]
    private Collection $PlanningEventss;

        public function getPlanningEventss(): Collection
        {
            return $this->PlanningEventss;
        }
    
        public function addPlanningEvents(PlanningEvents $PlanningEvents): self
        {
            if (!$this->PlanningEventss->contains($PlanningEvents)) {
                $this->PlanningEventss[] = $PlanningEvents;
                $PlanningEvents->setId_event($this);
            }
    
            return $this;
        }
    
        public function removePlanningEvents(PlanningEvents $PlanningEvents): self
        {
            if ($this->PlanningEventss->removeElement($PlanningEvents)) {
                // set the owning side to null (unless already changed)
                if ($PlanningEvents->getId_event() === $this) {
                    $PlanningEvents->setId_event(null);
                }
            }
    
            return $this;
        }
}
