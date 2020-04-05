<?php

namespace App\Repository;

use App\Entity\Posicion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Posicion|null find($id, $lockMode = null, $lockVersion = null)
 * @method Posicion|null findOneBy(array $criteria, array $orderBy = null)
 * @method Posicion[]    findAll()
 * @method Posicion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PosicionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Posicion::class);
    }

    // /**
    //  * @return Posicion[] Returns an array of Posicion objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Posicion
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
