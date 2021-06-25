<?php

namespace App\Domains\User\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, string $entityClass)
    {
        parent::__construct($registry, $entityClass);
    }

    public function getOrderedUsers(?string $filter = null): array
    {
        $qb = $this->createQueryBuilder('u');

        if ($filter) {
            $qb->andWhere('u.email LIKE :filter OR u.username LIKE :filter')
                ->setParameter('filter', '%'.$filter.'%');
        }

        return $qb->getQuery()->getResult();
    }
}
