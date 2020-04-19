<?php

namespace App\Manager;

use App\Repository\EventoRepository;

class EventoManager 
{
    private $practicaManager;
    private $eventoRepository;
    
    public function __construct(PracticaManager $practicaManager, EventoRepository $eventoRepository)
    {
        $this->practicaManager = $practicaManager;
        $this->eventoRepository = $eventoRepository;
    }

    public function getEventsByDate()
    {
        return $this->eventoRepository->getAllOrderByDate();
    }
}