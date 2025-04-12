<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use App\Entity\Hebergement;

#[ORM\Entity]
#[ORM\Table(name: "reservation_hebergement")]
class ReservationHebergement
{

    #[ORM\Id]
    #[ORM\Column(type: "integer")]
    private int $id;
    
        #[ORM\ManyToOne(targetEntity: User::class, inversedBy: "reservation_hebergements")]
    #[ORM\JoinColumn(name: 'id_user', referencedColumnName: 'id', onDelete: 'CASCADE')]
    private User $idUser;

        #[ORM\ManyToOne(targetEntity: Hebergement::class, inversedBy: "reservation_hebergements")]
    #[ORM\JoinColumn(name: 'id_hebergement', referencedColumnName: 'id', onDelete: 'CASCADE')]
    private Hebergement $idHebergement;

    #[ORM\Column(type: "date")]
    private \DateTimeInterface $dateDebut;

    #[ORM\Column(type: "date")]
    private \DateTimeInterface $dateFin;

    #[ORM\Column(type: "integer")]
    private int $nbPerso;

    public function getId()
    {
        return $this->id;
    }

    public function setId($value)
    {
        $this->id = $value;
    }

    public function getIdUser()
    {
        return $this->idUser;
    }

    public function setIdUser($value)
    {
        $this->idUser = $value;
    }

    public function getIdHebergement()
    {
        return $this->idHebergement;
    }

    public function setIdHebergement($value)
    {
        $this->idHebergement = $value;
    }

    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    public function setDateDebut($value)
    {
        $this->dateDebut = $value;
    }

    public function getDateFin()
    {
        return $this->dateFin;
    }

    public function setDateFin($value)
    {
        $this->dateFin = $value;
    }

    public function getNbPerso()
    {
        return $this->nbPerso;
    }

    public function setNbPerso($value)
    {
        $this->nbPerso = $value;
    }
}
