<?php

namespace App\DataFixtures;

use App\Repository\UsuarioRepository;
use App\Entity\Mensaje;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class MensajesFixtures extends Fixture implements DependentFixtureInterface
{
    private $usuarioRepository;

    public function __construct(UsuarioRepository $usuarioRepository)
    {
        $this->usuarioRepository = $usuarioRepository;
    }

    public function load(ObjectManager $manager)
    {
        $usuarios = $this->usuarioRepository->findAll();
        $emisor = $usuarios[0];
        $receptor = $usuarios[1];

        $mensaje = new Mensaje();
        $mensaje->setEmisor($emisor);
        $mensaje->setReceptor($receptor);
        $mensaje->setTexto(
            'Esto es un mensaje de prueba con Emisor: '.$emisor->getEmail().'. Y receptor: '.$receptor->getEmail()
        );
        $manager->persist($mensaje);

        $mensaje2 = new Mensaje();
        $mensaje2->setEmisor($emisor);
        $mensaje2->setReceptor($receptor);
        $mensaje2->setTexto(
            'Esto es un mensaje de prueba con Emisor: '.$receptor->getEmail().'. Y receptor: '.$emisor->getEmail()
        );
        $manager->persist($mensaje2);
        
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            UsuarioFixtures::class,
        );
    }
}
