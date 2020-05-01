<?php

namespace App\DataFixtures;

use App\Entity\Evento;
use App\Repository\UsuarioRepository;
use App\Repository\DeporteRepository;
use App\Repository\LocalidadRepository;
use App\Repository\NivelRepository;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class EventoFixtures extends Fixture implements DependentFixtureInterface
{
    private $usuarioRepository;
    private $deporteRepository;
    private $nivelRepository;
    private $localidadRepository;

    public function __construct(
        UsuarioRepository $usuarioRepository, DeporteRepository $deporteRepository, NivelRepository $nivelRepository,
        LocalidadRepository $localidadRepository
        )
    {
        $this->usuarioRepository = $usuarioRepository;
        $this->deporteRepository = $deporteRepository;
        $this->nivelRepository = $nivelRepository;
        $this->localidadRepository = $localidadRepository;
    }

    public function load(ObjectManager $manager)
    {
        $tenis = $this->deporteRepository->findOneBy(['nombre'=>'Tenis']);
        $futbol = $this->deporteRepository->findOneBy(['nombre'=>'Futbol']);
        $baloncesto = $this->deporteRepository->findOneBy(['nombre'=>'Baloncesto']);
        $valencia = $this->localidadRepository->findOneBy(['Nombre'=>'Valencia']);
        $nivelesTenis = $this->nivelRepository->findBy(['deporte'=> $tenis]);
        $nivelesFutbol = $this->nivelRepository->findBy(['deporte'=> $futbol]);
        $nivelesBaloncesto = $this->nivelRepository->findBy(['deporte'=> $baloncesto]);
        $usuarios = $this->usuarioRepository->findAll();
        $hoy = new DateTime('now');

        $evento = new Evento();
        $evento->setDeporte($tenis);
        $evento->setLocalidad($valencia);
        $evento->setNivel($nivelesTenis[5]);
        $evento->setCreador($usuarios[0]);
        $evento->setTitle('Primer Evento de '.$tenis->getNombre());
        $evento->setDescripcion('Descripcion del evento de prueba creado por '.$usuarios[0]->getNombre());
        $evento->setDireccion('direccion de prueba');
        $evento->setRequeridos(2);
        $evento->setDia($hoy);
        $evento->setInicio(new DateTime('10:30'));
        $evento->setFinal(new DateTime('11:30'));

        $evento2 = new Evento();
        $evento2->setDeporte($baloncesto);
        $evento2->setLocalidad($valencia);
        $evento2->setNivel($nivelesBaloncesto[0]);
        $evento2->setCreador($usuarios[1]);
        $evento2->setTitle('Primer Evento de '.$baloncesto->getNombre());
        $evento2->setDescripcion('Descripcion del evento de prueba creado por '.$usuarios[1]->getNombre());
        $evento2->setDireccion('direccion de prueba');
        $evento2->setRequeridos(10);
        $evento2->setDia($hoy);
        $evento2->setInicio(new DateTime('16:30'));
        $evento2->setFinal(new DateTime('18:30'));

        $evento3 = new Evento();
        $evento3->setDeporte($futbol);
        $evento3->setLocalidad($valencia);
        $evento3->setNivel($nivelesFutbol[0]);
        $evento3->setCreador($usuarios[0]);
        $evento3->setTitle('Primer Evento de '.$futbol->getNombre());
        $evento3->setDescripcion('Descripcion del evento de prueba creado por '.$usuarios[0]->getNombre());
        $evento3->setDireccion('direccion de prueba');
        $evento3->setRequeridos(22);
        $evento3->setDia($hoy);
        $evento3->setInicio(new DateTime('19:30'));
        $evento3->setFinal(new DateTime('20:30'));


        $manager->persist($evento);
        $manager->persist($evento2);

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
