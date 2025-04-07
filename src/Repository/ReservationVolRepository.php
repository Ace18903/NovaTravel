<?php

namespace App\Repository;

use App\Entity\ReservationVol;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class Reservation_volRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReservationVol::class);
    }

    // Add custom methods as needed
}