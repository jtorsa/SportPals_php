<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\Usuario;
use App\Repository\LocalidadRepository;
use DateTime;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class UsuarioFixtures extends Fixture implements DependentFixtureInterface
{
    private $passwordEncoder;
    private $localidadRepository;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder, LocalidadRepository $localidadRepository)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->localidadRepository = $localidadRepository;
    }

    public function load(ObjectManager $manager)
    {
       $localidades = $this->localidadRepository->findAll();
        $num = sizeof($localidades)-1;

        $user = new Usuario();
        $user->setEmail('admin@mail.com');
        $user->setNombre('Nombre');
        $user->setApellidos('Apellidos');
        $user->setEdad(18);
        $user->setNick('adminB');
        $user->setFechaAlta(new DateTime('now'));
        $user->setPassword($this->passwordEncoder->encodePassword(
                         $user,
                         '1234'
                     ));
        $user->setRoles(['ROLE_ADMIN']);
        $user->setAvatar('admin@mail.com.png');
        $user->setLocalidad($localidades[random_int (0 , $num )]);
        $manager->persist($user);

        $user2 = new Usuario();
        $user2->setEmail('avatar@mail.com');
        $user2->setNick('fdsfds78');
        $user2->setNombre('Nombre');
        $user2->setApellidos('Apellidos');
        $user2->setEdad(18);
        $user2->setFechaAlta(new DateTime('now'));
        $user2->setPassword($this->passwordEncoder->encodePassword(
                         $user2,
                         '1234'
                     ));
        $user2->setRoles(['ROLE_ADMIN']);
        $user2->setAvatar('avatar@mail.com.png');
        $user2->setLocalidad($localidades[random_int (0 , $num )]);
        $manager->persist($user2);

        $user3 = new Usuario();
        $user3->setEmail('user@mail.com');
        $user3->setNick('useryt89');
        $user3->setNombre('Nombre');
        $user3->setApellidos('Apellidos');
        $user3->setEdad(40);
        $user3->setFechaAlta(new DateTime('now'));
        $user3->setPassword($this->passwordEncoder->encodePassword(
                         $user3,
                         '1234'
                     ));
        $user3->setRoles(['ROLE_USER']);
        $user3->setAvatar('user@mail.com.png');
        $user3->setLocalidad($localidades[random_int (0 , $num )]);
        $manager->persist($user3);

        $user4 = new Usuario();
        $user4->setEmail('user4@mail.com');
        $user4->setNick('odod0990');
        $user4->setNombre('User3');
        $user4->setApellidos('Apellidos3');
        $user4->setEdad(40);
        $user4->setFechaAlta(new DateTime('now'));
        $user4->setPassword($this->passwordEncoder->encodePassword(
                         $user4,
                         '1234'
                     ));
        $user4->setRoles(['ROLE_USER']);
        $user4->setAvatar('user@mail.com.png');
        $user4->setLocalidad($localidades[random_int (0 , $num )]);
        $manager->persist($user4);

        

        $user5 = new Usuario();
        $user5->setEmail('user5@mail.com');
        $user5->setNick('garmazin');
        $user5->setNombre('Nombre5');
        $user5->setApellidos('Apellidos5');
        $user5->setEdad(18);
        $user5->setFechaAlta(new DateTime('now'));
        $user5->setPassword($this->passwordEncoder->encodePassword(
                         $user5,
                         '1234'
                     ));
        $user5->setRoles(['ROLE_USER']);
        $user5->setAvatar('user5@mail.com.png');
        $user5->setLocalidad($localidades[random_int (0 , $num )]);
        $manager->persist($user5);

        $user6 = new Usuario();
        $user6->setEmail('user6@mail.com');
        $user6->setNick('dfsfdofikds343');
        $user6->setNombre('Nombre6');
        $user6->setApellidos('Apellidos6');
        $user6->setEdad(18);
        $user6->setFechaAlta(new DateTime('now'));
        $user6->setPassword($this->passwordEncoder->encodePassword(
                         $user6,
                         '1234'
                     ));
        $user6->setRoles(['ROLE_USER']);
        $user6->setAvatar('user6@mail.com.png');
        $user6->setLocalidad($localidades[random_int (0 , $num )]);
        $manager->persist($user6);


        $user7 = new Usuario();
        $user7->setEmail('user7@mail.com');
        $user7->setNick('fdfd99');
        $user7->setNombre('Nombre7');
        $user7->setApellidos('7');
        $user7->setEdad(18);
        $user7->setFechaAlta(new DateTime('now'));
        $user7->setPassword($this->passwordEncoder->encodePassword(
                         $user7,
                         '1234'
                     ));
        $user7->setRoles(['ROLE_USER']);
        $user7->setAvatar('user7@mail.com.png');
        $user7->setLocalidad($localidades[random_int (0 , $num )]);
        $manager->persist($user7);

        $user8 = new Usuario();
        $user8->setEmail('user8@mail.com');
        $user8->setNick('sal09');
        $user8->setNombre('Nombre8');
        $user8->setApellidos('8');
        $user8->setEdad(18);
        $user8->setFechaAlta(new DateTime('now'));
        $user8->setPassword($this->passwordEncoder->encodePassword(
                         $user8,
                         '1234'
                     ));
        $user8->setRoles(['ROLE_USER']);
        $user8->setAvatar('user8@mail.com.png');
        $user8->setLocalidad($localidades[random_int (0 , $num )]);
        $manager->persist($user8);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            Provinciafixtures::class,
        );
    }
}
