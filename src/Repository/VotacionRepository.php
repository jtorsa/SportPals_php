<?php

namespace App\Repository;

use App\Entity\Votacion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Votacion|null find($id, $lockMode = null, $lockVersion = null)
 * @method Votacion|null findOneBy(array $criteria, array $orderBy = null)
 * @method Votacion[]    findAll()
 * @method Votacion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VotacionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Votacion::class);
    }

    // /**
    //  * @return Votacion[] Returns an array of Votacion objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Votacion
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
