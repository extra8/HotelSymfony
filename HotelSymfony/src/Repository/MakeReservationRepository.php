<?php

namespace App\Repository;

use App\Entity\MakeReservation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method MakeReservation|null find($id, $lockMode = null, $lockVersion = null)
 * @method MakeReservation|null findOneBy(array $criteria, array $orderBy = null)
 * @method MakeReservation[]    findAll()
 * @method MakeReservation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MakeReservationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MakeReservation::class);
    }

    // /**
    //  * @return MakeReservation[] Returns an array of MakeReservation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MakeReservation
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
