<?php

namespace App\Repository;

use App\Entity\Amistad;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Amistad|null find($id, $lockMode = null, $lockVersion = null)
 * @method Amistad|null findOneBy(array $criteria, array $orderBy = null)
 * @method Amistad[]    findAll()
 * @method Amistad[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AmistadRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Amistad::class);
    }

    // /**
    //  * @return Amistad[] Returns an array of Amistad objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Amistad
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
