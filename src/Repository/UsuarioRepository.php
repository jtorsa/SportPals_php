<?php

namespace App\Repository;

use App\Entity\Usuario;
use App\Entity\Evento;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @method Usuario|null find($id, $lockMode = null, $lockVersion = null)
 * @method Usuario|null findOneBy(array $criteria, array $orderBy = null)
 * @method Usuario[]    findAll()
 * @method Usuario[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsuarioRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Usuario::class);
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(UserInterface $user, string $newEncodedPassword): void
    {
        if (!$user instanceof Usuario) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newEncodedPassword);
        $this->_em->persist($user);
        $this->_em->flush();
    }

    /**
     * Devuelve los Usuarios la misma Localidad
     */
    public function mismaLocalidad()
    {
        $entityManager = $this->getEntityManager();  
        $query = $entityManager->createQuery(
            'SELECT u
            FROM App\Entity\Usuario u
            WHERE u NOT IN (:array)')
           // ->setParameter('amigos',$amigos);
            ;
        ;
        return $query->getResult();
    }

    public function getParticipantes(Evento $evento)
    {
        $entityManager = $this->getEntityManager();  
        $query = $entityManager->createQuery(
            'SELECT u.avatar, po.nombre, p.equipo
            FROM App\Entity\Evento e, App\Entity\Usuario u, App\Entity\Participa p, App\Entity\Posicion po
            WHERE e.id = :evento
            AND p.evento = e.id
            AND p.jugador = u.id
            AND p.posicion = po.id')
            ->setParameter('evento',$evento->getId());
            ;
        ;
        return $query->getResult();
    }

    // /**
    //  * @return Usuario[] Returns an array of Usuario objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Usuario
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
