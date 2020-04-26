<?php

namespace App\Service;

use App\Entity\Evento;
use App\Manager\EventoManager;
use App\Manager\PracticaManager;
use App\Manager\UsuarioManager;
use App\Repository\DeporteRepository;
use Symfony\Component\Security\Core\Security;

class EventService
{
    private $security;
    private $practicaManager;
    private $usuarioManager;
    private $eventoManager;

    public function __construct(Security $security, DeporteRepository $deporteRepository, PracticaManager $practicaManager, UsuarioManager $usuarioManager, EventoManager $eventoManager)
    {
        $this->security = $security;
        $this->deporteRepository = $deporteRepository;
        $this->practicaManager = $practicaManager;
        $this->usuarioManager = $usuarioManager;
        $this->eventoManager = $eventoManager;

    }

    /* función para devolver los eventos de la Localidad del usuario en los deportes practicados*/
    public function getUserEventsByLocalidad()
    {
        $user = $this->security->getUser();
        if(!$user){
            return $this->eventoManager->getAllEventsOrderByDate();
        }
        $practicados = $this->practicaManager->getDeportesPracticados($user);
        $localidad = $user->getLocalidad();
        return $this->eventoManager->getUserEventsByLocalidad($practicados, $localidad);
    }

    public function getParticipantesIndexedByPosition(Evento $evento) :array
    {
        $participantes = $this->usuarioManager->getParticipantes($evento);
        $participantesIndexed = [];
        foreach ($participantes as $participante ){
            $participantesIndexed[$participante['nombre'].$participante['equipo']] = $participante['avatar'];
        }
        return $participantesIndexed;
    }

    public function isRolled(Evento $evento) :bool
    {
        $user = $this->security->getUser();
        if(!$user){
            return false;
        }
        $participantes = $this->usuarioManager->getParticipantes($evento);
        foreach($participantes as $participante){
            if($user->getAvatar()== $participante['avatar']){
                return true;
            }
        }
        return false;
    }

    public function getCourtTwig(Evento $evento)
    {
        return '\/courts/'.$evento->getDeporte()->getNombre().'.html.twig';
    }

}
