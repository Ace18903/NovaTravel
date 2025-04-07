<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use App\Entity\Vol;

#[ORM\Entity]
#[ORM\Table(name: "vol_reservation")]
class ReservationVol
{

    #[ORM\Id]
    #[ORM\Column(type: "integer")]
    private int $id;

        #[ORM\ManyToOne(targetEntity: User::class, inversedBy: "reservation_vols")]
    #[ORM\JoinColumn(name: 'id_user', referencedColumnName: 'id', onDelete: 'CASCADE')]
    private User $id_user;

        #[ORM\ManyToOne(targetEntity: Vol::class, inversedBy: "reservation_vols")]
    #[ORM\JoinColumn(name: 'id_vol', referencedColumnName: 'id', onDelete: 'CASCADE')]
    private Vol $id_vol;

    #[ORM\Column(type: "string", length: 50)]
    private string $classe;

    #[ORM\Column(type: "integer")]
    private int $nb_billets;

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

    public function getId_vol()
    {
        return $this->id_vol;
    }

    public function setId_vol($value)
    {
        $this->id_vol = $value;
    }

    public function getClasse()
    {
        return $this->classe;
    }

    public function setClasse($value)
    {
        $this->classe = $value;
    }

    public function getNb_billets()
    {
        return $this->nb_billets;
    }

    public function setNb_billets($value)
    {
        $this->nb_billets = $value;
    }
}
