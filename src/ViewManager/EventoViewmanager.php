<?php

namespace App\ViewManager;

use App\ViewManager\AppViewmanager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Security;
use App\Entity\Evento;
use App\Manager\ComentarioManager;
use App\Manager\EventoManager;
use App\Manager\UsuarioManager;
use App\Service\EventService;
use App\Service\ParticipaService;
use App\Service\VotacionService;

class EventoViewmanager extends AbstractController
{
    private $appViewmanager;
    private $usuarioManager;
    private $eventService;
    private $participaService;
    private $comentarioManager;
    private $votacionService;
    private $security;

    public function __construct( 
        AppViewmanager $appViewmanager,
        Security $security,
        UsuarioManager $usuarioManager, 
        EventService $eventService, 
        EventoManager $eventoManager,
        ParticipaService $participaService,
        ComentarioManager $comentarioManager,
        VotacionService $votacionService
        )
    {
        $this->appViewmanager = $appViewmanager;
        $this->security = $security;
        $this->usuarioManager = $usuarioManager;
        $this->eventService = $eventService;
        $this->eventoManager = $eventoManager;
        $this->participaService = $participaService;
        $this->comentarioManager = $comentarioManager;
        $this->votacionService = $votacionService;
    }
    
    public function index()
    {
        $global = $this->appViewmanager->index();
        $global['eventos'] = $this->participaService->getPlayersByEvent();

        return $global;
        
    }

    public function new (Request $request)
    {
    }

    public function show(Evento $evento)
    {
        
        $global = $this->appViewmanager->index();
        $global['rolled'] = $this->eventService->isRolled($evento);
        $global['participantes'] = $this->eventService->getParticipantesIndexedByPosition($evento);
        $global['votos'] = $this->votacionService->getAverageRateByEvent($global['participantes'], $evento);
        $global['evento'] = $evento;    
        $global['court'] = $this->eventService->getCourtTwig($evento);
        $global['sameHour'] = $this->eventService->eventSameHour($evento);
        $global['comentarios'] = $this->comentarioManager->getEventComments($evento);

        return $global;
    }
}
