<?php

namespace App\ViewManager;

use App\ViewManager\AppViewmanager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Security;
use App\Entity\Evento;
use App\Manager\UsuarioManager;
use App\Service\EventService;

class EventoViewmanager extends AbstractController
{
    private $appViewmanager;
    private $usuarioManager;
    private $eventService;
    private $security;

    public function __construct( AppViewmanager $appViewmanager, Security $security, UsuarioManager $usuarioManager, EventService $eventService)
    {
        $this->appViewmanager = $appViewmanager;
        $this->security = $security;
        $this->usuarioManager = $usuarioManager;
        $this->eventService = $eventService;
    }
    
    public function index()
    {
    }

    public function new (Request $request)
    {
    }

    public function show(Evento $evento)
    {
        $global = $this->appViewmanager->index();
        $global['rolled'] = $this->eventService->isRolled($evento);
        $global['participantes'] = $this->eventService->getParticipantesIndexedByPosition($evento);
        $global['evento'] = $evento;    
        $global['court'] = $this->eventService->getCourtTwig($evento);    
        return $global;
    }
}
