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
    private Reclamation $idReclamation;

    #[ORM\Column(type: "string", length: 255)]
    private string $message;

    #[ORM\Column(type: "date")]
    private \DateTimeInterface $dateReponse;

    public function getId()
    {
        return $this->id;
    }

    public function setId($value)
    {
        $this->id = $value;
    }

    public function getIdReclamation()
    {
        return $this->idReclamation;
    }

    public function setIdReclamation($value)
    {
        $this->idReclamation = $value;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($value)
    {
        $this->message = $value;
    }

    public function getDateReponse()
    {
        return $this->dateReponse;
    }

    public function setDateReponse($value)
    {
        $this->dateReponse = $value;
    }
}
