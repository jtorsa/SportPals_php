<?php

namespace App\Manager;

use App\Entity\Usuario;
use App\Repository\DeporteRepository;

class DeporteManager 
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