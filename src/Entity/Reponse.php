<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use App\Entity\Reclamation;

#[ORM\Entity]
class Reponse
{

    #[ORM\Id]
    #[ORM\Column(type: "integer")]
    private int $id;

        #[ORM\ManyToOne(targetEntity: Reclamation::class, inversedBy: "reponses")]
    #[ORM\JoinColumn(name: 'id_reclamation', referencedColumnName: 'id', onDelete: 'CASCADE')]
    private Reclamation $id_reclamation;

    #[ORM\Column(type: "string", length: 255)]
    private string $message;

    #[ORM\Column(type: "date")]
    private \DateTimeInterface $date_reponse;

    public function getId()
    {
        return $this->id;
    }

    public function setId($value)
    {
        $this->id = $value;
    }

    public function getId_reclamation()
    {
        return $this->id_reclamation;
    }

    public function setId_reclamation($value)
    {
        $this->id_reclamation = $value;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($value)
    {
        $this->message = $value;
    }

    public function getDate_reponse()
    {
        return $this->date_reponse;
    }

    public function setDate_reponse($value)
    {
        $this->date_reponse = $value;
    }
}
