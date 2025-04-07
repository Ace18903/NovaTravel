<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\Collection;
use App\Entity\ReservationVol;

#[ORM\Entity]
class Vol
{

    #[ORM\Id]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "string", length: 100)]
    private string $compagnie;

    #[ORM\Column(type: "string", length: 100)]
    private string $aeroportDepart;

    #[ORM\Column(type: "string", length: 100)]
    private string $aeroportArrivee;

    #[ORM\Column(type: "date")]
    private \DateTimeInterface $dateDepart;

    #[ORM\Column(type: "date")]
    private \DateTimeInterface $dateArrivee;

    #[ORM\Column(type: "float")]
    private float $prix;

    #[ORM\Column(type: "string", length: 100)]
    private string $destination;

    public function getId()
    {
        return $this->id;
    }

    public function setId($value)
    {
        $this->id = $value;
    }

    public function getCompagnie()
    {
        return $this->compagnie;
    }

    public function setCompagnie($value)
    {
        $this->compagnie = $value;
    }

    public function getAeroportDepart()
    {
        return $this->aeroportDepart;
    }

    public function setAeroportDepart($value)
    {
        $this->aeroportDepart = $value;
    }

    public function getAeroportArrivee()
    {
        return $this->aeroportArrivee;
    }

    public function setAeroportArrivee($value)
    {
        $this->aeroportArrivee = $value;
    }

    public function getDateDepart()
    {
        return $this->dateDepart;
    }

    public function setDateDepart($value)
    {
        $this->dateDepart = $value;
    }

    public function getDateArrivee()
    {
        return $this->dateArrivee;
    }

    public function setDateArrivee($value)
    {
        $this->dateArrivee = $value;
    }

    public function getPrix()
    {
        return $this->prix;
    }

    public function setPrix($value)
    {
        $this->prix = $value;
    }

    public function getDestination()
    {
        return $this->destination;
    }

    public function setDestination($value)
    {
        $this->destination = $value;
    }

    #[ORM\OneToMany(mappedBy: "id_vol", targetEntity: ReservationVol::class)]
    private Collection $ReservationVols;

        public function getReservationVols(): Collection
        {
            return $this->ReservationVols;
        }
    
        public function addReservationVol(ReservationVol $ReservationVol): self
        {
            if (!$this->ReservationVols->contains($ReservationVol)) {
                $this->ReservationVols[] = $ReservationVol;
                $ReservationVol->setId_vol($this);
            }
    
            return $this;
        }
    
        public function removeReservationVol(ReservationVol $ReservationVol): self
        {
            if ($this->ReservationVols->removeElement($ReservationVol)) {
                // set the owning side to null (unless already changed)
                if ($ReservationVol->getId_vol() === $this) {
                    $ReservationVol->setId_vol(null);
                }
            }
    
            return $this;
        }
}
