<?php

namespace App\Manager;

use App\Entity\Localidad;
use App\Entity\Usuario;
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

    public function getUserEventsByLocalidad(array $practicados, Localidad $localidad)
    {
        return $this->eventoRepository->getUserEventsByLocalidad($practicados, $localidad);
    }

    public function getUserEventsByLocalidadLimit4(array $practicados, Localidad $localidad)
    {
        return $this->eventoRepository->getUserEventsByLocalidadLimit4($practicados, $localidad);
    }

    public function getUserEventsNOTPracticadesByLocalidadLimit4(array $practicados, Localidad $localidad)
    {
        return $this->eventoRepository->getUserEventsNOTPracticadesByLocalidadLimit4($practicados, $localidad);
    }

    public function getById(string $id)
    {
        return $this->eventoRepository->findOneBy(['id'=>$id]);
    }

    public function getUserEvents(Usuario $usuario)
    {
        return $this->eventoRepository->getUserEvents($usuario);
    }
}