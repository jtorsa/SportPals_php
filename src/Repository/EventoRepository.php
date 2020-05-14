<?php

namespace App\Repository;

use App\Entity\Evento;
use App\Entity\Localidad;
use App\Entity\Usuario;
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
      public function getUserEventsByLocalidad(array $practicados, Localidad $localidad)
    {
        $entityManager = $this->getEntityManager();  
            $query = $entityManager->createQuery(
            'SELECT e 
            FROM  App\Entity\Evento e
            WHERE e.localidad = :id
            AND e.deporte IN ('.implode(',',$practicados).')'
        ); 
        $query->setParameter("id", $localidad->getId());

        return $query->getResult();
    }

    /**
      * @return Evento[] Returns an array of Evento objects
      */
      public function getUserEventsByLocalidadLimit4(array $practicados, Localidad $localidad)
    {
        if(empty($practicados)){
            return null;
        }else{

        
            $entityManager = $this->getEntityManager();  
            $query = $entityManager->createQuery(
            'SELECT e 
            FROM  App\Entity\Evento e
            WHERE e.localidad = :id
            AND e.deporte IN ('.implode(',',$practicados).')'
        ); 
        $query->setParameter("id", $localidad->getId());
        $query->setMaxResults(4);

        return $query->getResult();
    }
    }

    /**
      * @return Evento[] Returns an array of Evento objects
      */
      public function getUserEventsNOTPracticadesByLocalidadLimit4(array $practicados, Localidad $localidad)
    {
        $entityManager = $this->getEntityManager();
        if(empty($practicados)){
            $query = $entityManager->createQuery(
                'SELECT e 
                FROM  App\Entity\Evento e
                WHERE e.localidad = :id'
            ); 
        }else{
            $entityManager = $this->getEntityManager();  
            $query = $entityManager->createQuery(
                'SELECT e 
                FROM  App\Entity\Evento e
                WHERE e.localidad = :id
                AND e.deporte NOT IN ('.implode(',',$practicados).')'
            ); 
        }
        $query->setParameter("id", $localidad->getId());
        $query->setMaxResults(4);

        return $query->getResult();
    }
    
    /**
      * @return Evento[] Returns an array of Evento objects
      */
      public function getUserEvents(Usuario $usuario)
    {
        $entityManager = $this->getEntityManager();  
            $query = $entityManager->createQuery(
            'SELECT e 
            FROM  App\Entity\Evento e, App\Entity\Participa p
            WHERE e.id = p.evento
            AND p.jugador = :id'
        ); 
        $query->setParameter("id", $usuario->getId());

        return $query->getResult();
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
