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
    
    public function getDeportesNoPracticados(Usuario $usuario)
    {
        $practicados = $usuario->getDeportesPracticados();
        $arrayIds = [];
        foreach($practicados as $practicado){
            $arrayIds[] = $practicado->getDeporte()->getId();
        }
        $entityManager = $this->getEntityManager();  
                $query = $entityManager->createQuery(
                    'SELECT d.id
                    FROM App\Entity\Deporte d
                    WHERE d NOT IN (:array)')
                ->setParameter('array',$arrayIds);
                dump($usuario->getId(),$query->getResult());die;
                ;
        ;
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
