<?php

namespace App\DataFixtures;

use App\Repository\UsuarioRepository;
use App\Entity\Participa;
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
        $tenis = $this->deporteRepository->findOneBy(['Nombre'=>'Tenis']);
        $futbol = $this->deporteRepository->findOneBy(['Nombre'=>'Futbol']);
        $baloncesto = $this->deporteRepository->findOneBy(['Nombre'=>'Baloncesto']);
        $nivelesTenis = $this->nivelRepository->findBy(['deporte'=> $tenis]);
        $nivelesFutbol = $this->nivelRepository->findBy(['deporte'=> $futbol]);
        $nivelesBaloncesto = $this->nivelRepository->findBy(['deporte'=> $baloncesto]);
        $usuarios = $this->usuarioRepository->findAll();
        $participante = $usuarios[0];

        $participa = new Participa();
        $participa->setJugador($participante);
        $participa->setNivel($nivelesTenis[4]);
        $participa->setDeporte($tenis);

        $participa0 = new Participa();
        $participa0->setJugador($participante);
        $participa0->setNivel($nivelesFutbol[0]);
        $participa0->setDeporte($futbol);

        $participa1 = new Participa();
        $participa1->setJugador($participante);
        $participa1->setNivel($nivelesBaloncesto[0]);
        $participa1->setDeporte($baloncesto);

        $participa2 = new Participa();
        $participa2->setJugador($usuarios[1]);
        $participa2->setNivel($nivelesTenis[1]);
        $participa2->setDeporte($tenis);
        
        $manager->persist($participa);
        $manager->persist($participa0);
        $manager->persist($participa1);
        $manager->persist($participa2);

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
