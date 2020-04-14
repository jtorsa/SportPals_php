<?php

namespace App\Manager;

use App\Entity\Usuario;
use App\Repository\DeporteRepository;

class EventoManager 
{
    private $deporteRepository;
    
    public function __construct(DeporteRepository $deporteRepository)
    {
        $this->deporteRepository = $deporteRepository;
    }

public function getDeportesNoPracticados()
    {
    }
}