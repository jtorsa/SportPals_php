<?php

namespace App\DataFixtures;

use App\Entity\Posicion;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Repository\DeporteRepository;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class PosicionFixtures extends Fixture implements DependentFixtureInterface
{
    private $deporteRepository;

    public function __construct(DeporteRepository $deporteRepository)
    {
        $this->deporteRepository = $deporteRepository;
    }

    public function load(ObjectManager $manager)
    {
        $tenis = $this->deporteRepository->findOneBy(['Nombre'=>'Tenis']);
        $futbol = $this->deporteRepository->findOneBy(['Nombre'=>'Futbol']);
        $baloncesto = $this->deporteRepository->findOneBy(['Nombre'=>'Baloncesto']);
        $padel = $this->deporteRepository->findOneBy(['Nombre'=>'Padel']);

        $posicion = new Posicion;
        $posicion->setNombre('Portero');
        $posicion->setDeporte($futbol);

        $posicion1 = new Posicion;
        $posicion1->setNombre('Defensa');
        $posicion1->setDeporte($futbol);

        $posicion3 = new Posicion;
        $posicion3->setNombre('Centrocampista');
        $posicion3->setDeporte($futbol);

        $posicion2 = new Posicion;
        $posicion2->setNombre('Delantero');
        $posicion2->setDeporte($futbol);
/*****************************************/
        $posicion7 = new Posicion;
        $posicion7->setNombre('Base');
        $posicion7->setDeporte($baloncesto);

        $posicion4 = new Posicion;
        $posicion4->setNombre('Escolta');
        $posicion4->setDeporte($baloncesto);

        $posicion5 = new Posicion;
        $posicion5->setNombre('Alero');
        $posicion5->setDeporte($baloncesto);

        $posicion6 = new Posicion;
        $posicion6->setNombre('Ala-Pivot');
        $posicion6->setDeporte($baloncesto);

        $posicion8 = new Posicion;
        $posicion8->setNombre('Pivot');
        $posicion8->setDeporte($baloncesto);

        $manager->persist($posicion);
        $manager->persist($posicion1);
        $manager->persist($posicion2);
        $manager->persist($posicion3);
        $manager->persist($posicion4);
        $manager->persist($posicion5);
        $manager->persist($posicion6);
        $manager->persist($posicion7);
        $manager->persist($posicion8);


        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            DeporteFixtures::class,
        );
    }
}
