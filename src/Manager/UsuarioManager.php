<?php

namespace App\Manager;

use App\Entity\Localidad;
use App\Repository\AmistadRepository;
use App\Repository\UsuarioRepository;

class UsuarioManager 
{
    private $usuarioRepository;
    private $amistadRepository;

    public function __construct(UsuarioRepository $usuarioRepository, AmistadRepository $amistadRepository)
    {
        $this->usuarioRepository = $usuarioRepository;
        $this->amistadRepository = $amistadRepository;
    }

    public function mismaLocalidad(Localidad $localidad)
    {

    }

    public function getAmigos()
    {
        $this->amistadRepository->findBy();
    }
}