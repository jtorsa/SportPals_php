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
        $tenis = $this->deporteRepository->findOneBy(['nombre'=>'Tenis']);
        $futbol = $this->deporteRepository->findOneBy(['nombre'=>'Futbol']);
        $baloncesto = $this->deporteRepository->findOneBy(['nombre'=>'Baloncesto']);
        $padel = $this->deporteRepository->findOneBy(['nombre'=>'Padel']);
        $balonmano = $this->deporteRepository->findOneBy(['nombre'=>'Balonmano']);
        

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
        /**********************************/
        $posicion9 = new Posicion;
        $posicion9->setNombre('Derecha');
        $posicion9->setDeporte($tenis);
        /******************************* */
        $posicionBal1 = new Posicion;
        $posicionBal1->setNombre('Portero');
        $posicionBal1->setDeporte($balonmano);

        $posicionBal2 = new Posicion;
        $posicionBal2->setNombre('Extremo');
        $posicionBal2->setDeporte($balonmano);

        $posicionBal3 = new Posicion;
        $posicionBal3->setNombre('Lateral');
        $posicionBal3->setDeporte($balonmano);

        $posicionBal4 = new Posicion;
        $posicionBal4->setNombre('Central');
        $posicionBal4->setDeporte($balonmano);

        $posicionBal5 = new Posicion;
        $posicionBal5->setNombre('Pivote');
        $posicionBal5->setDeporte($balonmano);

        /***************************** */
        $posicionPad = new Posicion;
        $posicionPad->setNombre('Derecha');
        $posicionPad->setDeporte($padel);

        $posicionPad1 = new Posicion;
        $posicionPad1->setNombre('Revés');
        $posicionPad1->setDeporte($padel);



        $manager->persist($posicion);
        $manager->persist($posicion1);
        $manager->persist($posicion2);
        $manager->persist($posicion3);
        $manager->persist($posicion4);
        $manager->persist($posicion5);
        $manager->persist($posicion6);
        $manager->persist($posicion7);
        $manager->persist($posicion8);
        $manager->persist($posicion9);
        $manager->persist($posicionBal1);
        $manager->persist($posicionBal2);
        $manager->persist($posicionBal3);
        $manager->persist($posicionBal4);
        $manager->persist($posicionBal5);
        $manager->persist($posicionPad);
        $manager->persist($posicionPad1);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            DeporteFixtures::class,
        );
    }
}
