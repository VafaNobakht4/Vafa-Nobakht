<?php

namespace App\Service;

use App\Entity\Hotel;
use Doctrine\ORM\EntityManagerInterface;

class Search {

    private EntityManagerInterface $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function search (String $input): iterable {
         $hotelRep = $this->manager->getRepository(Hotel::class);
        return $hotelRep->createQueryBuilder('h')->where('h.name like :q')->setParameter('q', '%' . $input . '%')->getQuery()->getResult();
    }
}