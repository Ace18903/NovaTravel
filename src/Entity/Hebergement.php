<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\Collection;
use App\Entity\ReservationHebergement;

#[ORM\Entity]
class Hebergement
{

    #[ORM\Id]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "string", length: 50)]
    private string $type;

    #[ORM\Column(type: "string", length: 100)]
    private string $nom;

    #[ORM\Column(type: "string", length: 255)]
    private string $adresse;

    #[ORM\Column(type: "string", length: 255)]
    private string $description;

    #[ORM\Column(type: "float")]
    private float $prixNuit;

    #[ORM\Column(type: "string", length: 255)]
    private string $photo;

    public function getId()
    {
        return $this->id;
    }

    public function setId($value)
    {
        $this->id = $value;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($value)
    {
        $this->type = $value;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($value)
    {
        $this->nom = $value;
    }

    public function getAdresse()
    {
        return $this->adresse;
    }

    public function setAdresse($value)
    {
        $this->adresse = $value;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($value)
    {
        $this->description = $value;
    }

    public function getPrixNuit()
    {
        return $this->prixNuit;
    }

    public function setPrixNuit($value)
    {
        $this->prixNuit = $value;
    }

    public function getPhoto()
    {
        return $this->photo;
    }

    public function setPhoto($value)
    {
        $this->photo = $value;
    }

    #[ORM\OneToMany(mappedBy: "id_hebergement", targetEntity: ReservationHebergement::class)]
    private Collection $reservation_hebergements;

        public function getReservation_hebergements(): Collection
        {
            return $this->reservation_hebergements;
        }
    
        public function addReservation_hebergement(ReservationHebergement $reservation_hebergement): self
        {
            if (!$this->reservation_hebergements->contains($reservation_hebergement)) {
                $this->reservation_hebergements[] = $reservation_hebergement;
                $reservation_hebergement->setId_hebergement($this);
            }
    
            return $this;
        }
    
        public function removeReservation_hebergement(ReservationHebergement $reservation_hebergement): self
        {
            if ($this->reservation_hebergements->removeElement($reservation_hebergement)) {
                // set the owning side to null (unless already changed)
                if ($reservation_hebergement->getId_hebergement() === $this) {
                    $reservation_hebergement->setId_hebergement(null);
                }
            }
    
            return $this;
        }
}
