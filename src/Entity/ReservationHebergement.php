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
    private User $id_user;

        #[ORM\ManyToOne(targetEntity: Hebergement::class, inversedBy: "reservation_hebergements")]
    #[ORM\JoinColumn(name: 'id_hebergement', referencedColumnName: 'id', onDelete: 'CASCADE')]
    private Hebergement $id_hebergement;

    #[ORM\Column(type: "date")]
    private \DateTimeInterface $date_debut;

    #[ORM\Column(type: "date")]
    private \DateTimeInterface $date_fin;

    #[ORM\Column(type: "integer")]
    private int $nb_perso;

    public function getId()
    {
        return $this->id;
    }

    public function setId($value)
    {
        $this->id = $value;
    }

    public function getId_user()
    {
        return $this->id_user;
    }

    public function setId_user($value)
    {
        $this->id_user = $value;
    }

    public function getId_hebergement()
    {
        return $this->id_hebergement;
    }

    public function setId_hebergement($value)
    {
        $this->id_hebergement = $value;
    }

    public function getDate_debut()
    {
        return $this->date_debut;
    }

    public function setDate_debut($value)
    {
        $this->date_debut = $value;
    }

    public function getDate_fin()
    {
        return $this->date_fin;
    }

    public function setDate_fin($value)
    {
        $this->date_fin = $value;
    }

    public function getNb_perso()
    {
        return $this->nb_perso;
    }

    public function setNb_perso($value)
    {
        $this->nb_perso = $value;
    }
}
