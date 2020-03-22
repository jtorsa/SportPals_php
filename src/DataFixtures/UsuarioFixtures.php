<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\Usuario;
use DateTime;

class UsuarioFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new Usuario();
        $user->setEmail('admin@mail.com');
        $user->setSexo('H');
        $user->setNombre('Nombre');
        $user->setApellidos('Apellidos');
        $user->setEdad(18);
        $user->setFechaAlta(new DateTime('now'));
        $user->setPassword($this->passwordEncoder->encodePassword(
                         $user,
                         '1234'
                     ));
        $user->setRoles(['ROLE_ADMIN']);
        $user->setAvatar('admin@mail.com.png');
        $manager->persist($user);

        $user2 = new Usuario();
        $user2->setEmail('avatar@mail.com');
        $user2->setSexo('M');
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
        $manager->persist($user2);

        $user3 = new Usuario();
        $user3->setEmail('user@mail.com');
        $user3->setSexo('H');
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
        $manager->persist($user3);

        $manager->flush();
    }
}
