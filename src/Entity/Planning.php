<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\Collection;
use App\Entity\PlanningEvents;

#[ORM\Entity]
class Planning
{

    #[ORM\Id]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "string", length: 255)]
    private string $dateCreation;

    #[ORM\Column(type: "string", length: 255)]
    private string $nom;

    public function getId()
    {
        return $this->id;
    }

    public function setId($value)
    {
        $this->id = $value;
    }

    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    public function setDateCreation($value)
    {
        $this->dateCreation = $value;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($value)
    {
        $this->nom = $value;
    }

    #[ORM\OneToMany(mappedBy: "id_planning", targetEntity: PlanningEvents::class)]
    private Collection $PlanningEvents;

        public function getPlanningEvents(): Collection
        {
            return $this->PlanningEvents;
        }
    
        public function addPlanningEvents(PlanningEvents $PlanningEvents): self
        {
            if (!$this->PlanningEvents->contains($PlanningEvents)) {
                $this->PlanningEvents[] = $PlanningEvents;
                $PlanningEvents->setId_planning($this);
            }
    
            return $this;
        }
    
        public function removePlanningEvents(PlanningEvents $PlanningEvents): self
        {
            if ($this->PlanningEvents->removeElement($PlanningEvents)) {
                // set the owning side to null (unless already changed)
                if ($PlanningEvents->getId_planning() === $this) {
                    $PlanningEvents->setId_planning(null);
                }
            }
    
            return $this;
        }
}
