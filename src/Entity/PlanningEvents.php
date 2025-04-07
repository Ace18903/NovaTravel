<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use App\Entity\Event;

#[ORM\Entity]
#[ORM\Table(name: "PlanningEvents")]
class PlanningEvents
{

    #[ORM\Id]
        #[ORM\ManyToOne(targetEntity: Planning::class, inversedBy: "PlanningEvents")]
    #[ORM\JoinColumn(name: 'id_planning', referencedColumnName: 'id', onDelete: 'CASCADE')]
    private Planning $id_planning;

    #[ORM\Id]
        #[ORM\ManyToOne(targetEntity: Event::class, inversedBy: "PlanningEvents")]
    #[ORM\JoinColumn(name: 'id_event', referencedColumnName: 'id', onDelete: 'CASCADE')]
    private Event $id_event;

    public function getId_planning()
    {
        return $this->id_planning;
    }

    public function setId_planning($value)
    {
        $this->id_planning = $value;
    }

    public function getId_event()
    {
        return $this->id_event;
    }

    public function setId_event($value)
    {
        $this->id_event = $value;
    }
}
