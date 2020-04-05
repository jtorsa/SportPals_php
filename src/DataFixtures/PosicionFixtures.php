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

        $posicion = new Posicion;
        $posicion->setNombre('Defensa');
        $posicion->setDeporte($futbol);

        $posicion = new Posicion;
        $posicion->setNombre('Centrocampista');
        $posicion->setDeporte($futbol);

        $posicion = new Posicion;
        $posicion->setNombre('Delantero');
        $posicion->setDeporte($futbol);
/*****************************************/
        $posicion = new Posicion;
        $posicion->setNombre('Base');
        $posicion->setDeporte($baloncesto);

        $posicion = new Posicion;
        $posicion->setNombre('Escolta');
        $posicion->setDeporte($baloncesto);

        $posicion = new Posicion;
        $posicion->setNombre('Alero');
        $posicion->setDeporte($baloncesto);

        $posicion = new Posicion;
        $posicion->setNombre('Ala-pivot');
        $posicion->setDeporte($baloncesto);

        $posicion = new Posicion;
        $posicion->setNombre('Pivot');
        $posicion->setDeporte($baloncesto);
    }

    public function getDependencies()
    {
        return array(
            DeporteFixtures::class,
        );
    }
}
