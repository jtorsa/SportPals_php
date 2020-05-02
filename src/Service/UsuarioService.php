<?php

namespace App\Service;

use App\Manager\UsuarioManager;

class UsuarioService
{

    private $usuarioManager;

    public function __construct(UsuarioManager $usuarioManager)
    {
        $this->usuarioManager = $usuarioManager;
    }

    public function getMostUsersCities()
    {
        return $this->usuarioManager->getMostUsersCities();
    }

}
