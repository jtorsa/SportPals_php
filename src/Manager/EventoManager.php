<?php

namespace App\Manager;

use App\Entity\Localidad;
use App\Repository\EventoRepository;
use Doctrine\Common\Collections\Collection;

class EventoManager 
{
    private $practicaManager;
    private $eventoRepository;
    
    public function __construct(PracticaManager $practicaManager, EventoRepository $eventoRepository)
    {
        $this->practicaManager = $practicaManager;
        $this->eventoRepository = $eventoRepository;
    }

    public function getAllEventsOrderByDate()
    {
        return $this->eventoRepository->getAllEventsOrderByDate();
    }

    public function getUserEventsByLocalidad(Collection $practicados, Localidad $localidad)
    {
        return $this->eventoRepository->getUserEventsByLocalidad($practicados, $localidad);
    }
}