<?php

namespace App\Repository;

use App\Entity\Evento;
use App\Entity\Localidad;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Common\Collections\Collection;

/**
 * @method Evento|null find($id, $lockMode = null, $lockVersion = null)
 * @method Evento|null findOneBy(array $criteria, array $orderBy = null)
 * @method Evento[]    findAll()
 * @method Evento[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Evento::class);
    }

    /**
      * @return Evento[] Returns an array of Evento objects
      */
      public function getAllEventsOrderByDate()
    {
        return $this->createQueryBuilder('e')
            ->orderBy('e.dia', 'ASC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();
    }

    /**
      * @return Evento[] Returns an array of Evento objects
      */
      public function getUserEventsByLocalidad(Collection $practicados, Localidad $localidad)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.localidad = :localidad')
            ->setParameter('localidad', $localidad)
            ->orderBy('e.dia', 'ASC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();
    }
    
    // /**
    //  * @return Evento[] Returns an array of Evento objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Evento
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
