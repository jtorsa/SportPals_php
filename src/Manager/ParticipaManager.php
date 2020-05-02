<?php

namespace App\Manager;

use App\Entity\Usuario;
use App\Repository\DeporteRepository;
use App\Repository\PracticaRepository;
use App\Repository\ParticipaRepository;

class ParticipaManager 
{
    private $deporteRepository;
    private $practicaRepository;
    private $participaRepository;
    
    public function __construct(DeporteRepository $deporteRepository, PracticaRepository $practicaRepository, ParticipaRepository $participaRepository )
    {
        $this->deporteRepository = $deporteRepository;
        $this->practicaRepository = $practicaRepository;
        $this->participaRepository = $participaRepository;
    }

    /** Función que devuelve los deportes que aún no practica el usuario */
    public function getDeportesNoPracticados(Usuario $usuario)
    {
        $practicados = $usuario->getDeportesPracticados();
        $arrayIds = [];

        foreach($practicados as $practicado){
            $arrayIds[] = $practicado->getDeporte()->getId();
        }

        if(empty($arrayIds)){
            return $this->deporteRepository->findAll();
        }

        $noPracticados = $this->deporteRepository->getDeportesNoPracticados($arrayIds);

        return $noPracticados;
    }

    public function getDeportesPracticados(Usuario $usuario)
    {
        return $usuario->getDeportesPracticados();
    }
    
    public function getMostActiveCities()
    {
        return $this->participaRepository->getMostActiveCities();
    }
    
}