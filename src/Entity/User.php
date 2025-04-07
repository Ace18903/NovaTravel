<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\Collection;
use App\Entity\Reservation_vol;

#[ORM\Entity]
class User
{

    #[ORM\Id]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "string", length: 50)]
    private string $nom;

    #[ORM\Column(type: "string", length: 50)]
    private string $prenom;

    #[ORM\Column(type: "string", length: 20)]
    private string $cin;

    #[ORM\Column(type: "integer")]
    private int $tel;

    #[ORM\Column(type: "string", length: 50)]
    private string $role;

    #[ORM\Column(type: "string", length: 255)]
    private string $mail;

    #[ORM\Column(type: "string", length: 255)]
    private string $password;

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

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function setPrenom($value)
    {
        $this->prenom = $value;
    }

    public function getCin()
    {
        return $this->cin;
    }

    public function setCin($value)
    {
        $this->cin = $value;
    }

    public function getTel()
    {
        return $this->tel;
    }

    public function setTel($value)
    {
        $this->tel = $value;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($value)
    {
        $this->role = $value;
    }

    public function getMail()
    {
        return $this->mail;
    }

    public function setMail($value)
    {
        $this->mail = $value;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($value)
    {
        $this->password = $value;
    }

    #[ORM\OneToMany(mappedBy: "id_user", targetEntity: Reclamation::class)]
    private Collection $reclamations;

        public function getReclamations(): Collection
        {
            return $this->reclamations;
        }
    
        public function addReclamation(Reclamation $reclamation): self
        {
            if (!$this->reclamations->contains($reclamation)) {
                $this->reclamations[] = $reclamation;
                $reclamation->setId_user($this);
            }
    
            return $this;
        }
    
        public function removeReclamation(Reclamation $reclamation): self
        {
            if ($this->reclamations->removeElement($reclamation)) {
                // set the owning side to null (unless already changed)
                if ($reclamation->getId_user() === $this) {
                    $reclamation->setId_user(null);
                }
            }
    
            return $this;
        }

    #[ORM\OneToMany(mappedBy: "id_user", targetEntity: ReservationHebergement::class)]
    private Collection $ReservationHebergements;

    #[ORM\OneToMany(mappedBy: "id_user", targetEntity: ReservationVol::class)]
    private Collection $ReservationVols;
}