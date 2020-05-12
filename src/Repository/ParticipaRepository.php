<?php

namespace App\Repository;

use App\Entity\Participa;
use App\Entity\Usuario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Participa|null find($id, $lockMode = null, $lockVersion = null)
 * @method Participa|null findOneBy(array $criteria, array $orderBy = null)
 * @method Participa[]    findAll()
 * @method Participa[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParticipaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Participa::class);
    }

     /**
      * @return Participa[] Returns an array of Participa objects
      */
    
    public function userParticipas(Usuario $usuario)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.jugador = :jugador')
            ->setParameter('jugador', $usuario)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    public function getMostActiveCities()
    {
        $entityManager = $this->getEntityManager();  
        $query = $entityManager->createQuery(
            'SELECT l.Nombre, COUNT(e.localidad) AS num
            FROM  App\Entity\Localidad l, App\Entity\Evento e
            WHERE e.localidad = l.id
            GROUP BY l.Nombre'
        );

        return $query->getResult();
    }


    // /**
    //  * @return Participa[] Returns an array of Participa objects
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
    public function findOneBySomeField($value): ?Participa
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
