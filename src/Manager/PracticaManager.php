<?php

namespace App\Manager;

use App\Entity\Usuario;
use App\Repository\DeporteRepository;

class PracticaManager 
{
    private $deporteRepository;
    
    public function __construct(DeporteRepository $deporteRepository)
    {
        $this->deporteRepository = $deporteRepository;
    }

public function getDeportesNoPracticados(Usuario $usuario)
    {
        $practicados = $usuario->getDeportesPracticados();
        $arrayIds = [];
        foreach($practicados as $practicado){
            $arrayIds[] = $practicado->getDeporte()->getId();
        }
        $noPracticados = $this->deporteRepository->getDeportesNoPracticados($arrayIds);
        return $noPracticados;
    }
}