<?php

namespace App\Repository;

use App\Entity\Planning_events;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class Planning_eventsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Planning_events::class);
    }

    // Add custom methods as needed
}