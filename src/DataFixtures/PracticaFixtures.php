<?php

namespace App\DataFixtures;

use App\Repository\UsuarioRepository;
use App\Entity\Practica;
use App\Repository\DeporteRepository;
use App\Repository\NivelRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class PracticaFixtures extends Fixture implements DependentFixtureInterface
{
    private $usuarioRepository;
    private $deporteRepository;
    private $nivelRepository;

    public function __construct(UsuarioRepository $usuarioRepository, DeporteRepository $deporteRepository, NivelRepository $nivelRepository)
    {
        $this->usuarioRepository = $usuarioRepository;
        $this->deporteRepository = $deporteRepository;
        $this->nivelRepository = $nivelRepository;
    }

    public function load(ObjectManager $manager)
    {
        $tenis = $this->deporteRepository->findOneBy(['nombre'=>'Tenis']);
        $futbol = $this->deporteRepository->findOneBy(['nombre'=>'Futbol']);
        $baloncesto = $this->deporteRepository->findOneBy(['nombre'=>'Baloncesto']);
        $nivelesTenis = $this->nivelRepository->findBy(['deporte'=> $tenis]);
        $nivelesFutbol = $this->nivelRepository->findBy(['deporte'=> $futbol]);
        $nivelesBaloncesto = $this->nivelRepository->findBy(['deporte'=> $baloncesto]);
        $usuarios = $this->usuarioRepository->findAll();
        $practicante = $usuarios[0];

        $practica = new Practica();
        $practica->setJugador($practicante);
        $practica->setNivel($nivelesTenis[4]);
        $practica->setDeporte($tenis);

        $practica0 = new Practica();
        $practica0->setJugador($practicante);
        $practica0->setNivel($nivelesFutbol[0]);
        $practica0->setDeporte($futbol);

        $practica1 = new Practica();
        $practica1->setJugador($practicante);
        $practica1->setNivel($nivelesBaloncesto[0]);
        $practica1->setDeporte($baloncesto);

        $practica2 = new Practica();
        $practica2->setJugador($usuarios[1]);
        $practica2->setNivel($nivelesTenis[1]);
        $practica2->setDeporte($tenis);
        
        $manager->persist($practica);
        $manager->persist($practica0);
        $manager->persist($practica1);
        $manager->persist($practica2);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            UsuarioFixtures::class,
            DeporteFixtures::class,
            NivelFixtures::class
        );
    }
}
