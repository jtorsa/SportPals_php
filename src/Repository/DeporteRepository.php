<?php

namespace App\Repository;

use App\Entity\Deporte;
use App\Entity\Usuario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Deporte|null find($id, $lockMode = null, $lockVersion = null)
 * @method Deporte|null findOneBy(array $criteria, array $orderBy = null)
 * @method Deporte[]    findAll()
 * @method Deporte[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DeporteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Deporte::class);
    }

    /*
    SELECT * 
FROM SportSpals.deporte
WHERE id NOT IN (
	SELECT deporte_id 
FROM SportSpals.practica
WHERE jugador_id = 6
);
    */
  /**
      * @return Deporte[] Returns an array of Deporte objects
      */
    
    public function getDeportesNoPracticados(array $deportes)
    {
        $entityManager = $this->getEntityManager();  
        $query = $entityManager->createQuery(
            'SELECT d
            FROM App\Entity\Deporte d
            WHERE d NOT IN (:array)')
            ->setParameter('array',$deportes);
            ;
        ;
        return $query->getResult();
    }

    public function getMostPracticeds()
    {
        $entityManager = $this->getEntityManager();  
        $query = $entityManager->createQuery(
            'SELECT d.nombre, COUNT(p.deporte) AS num
            FROM App\Entity\Practica p, App\Entity\Deporte d
            WHERE p.deporte = d.id
            GROUP BY d.nombre'
        );

        return $query->getResult();
    }

    /*
    public function findOneBySomeField($value): ?Deporte
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
