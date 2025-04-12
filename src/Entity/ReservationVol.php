<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use App\Entity\Vol;

#[ORM\Entity]
#[ORM\Table(name: "reservation_vol")]
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
    private int $nbBillets;

    public function getId()
    {
        return $this->id;
    }

    public function setId($value)
    {
        $this->id = $value;
    }

    public function getIdUser(): User
{
    return $this->id_user;
}

public function setIdUser(User $user): self
{
    $this->id_user = $user;
    return $this;
}


public function getIdVol(): Vol
{
    return $this->id_vol;
}

public function setIdVol(Vol $vol): self
{
    $this->id_vol = $vol;
    return $this;
}

    public function getClasse()
    {
        return $this->classe;
    }

    public function setClasse($value)
    {
        $this->classe = $value;
    }

    public function getNbBillets(): int
    {
        return $this->nbBillets;
    }
    
    public function setNbBillets(int $nbBillets): self
    {
        $this->nbBillets = $nbBillets;
        return $this;
    }
    
}
