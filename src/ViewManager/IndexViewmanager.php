<?php

namespace App\ViewManager;

use App\Service\IndexService;
use App\ViewManager\AppViewmanager;
use App\Service\EventService;
use App\Service\ParticipaService;

class IndexViewmanager
{
    private $indexService;
    private $appViewmanager;
    private $eventService;
    private $participaService;

    public function __construct(IndexService $indexService, EventService $eventService, AppViewmanager $appViewmanager, ParticipaService $participaService)
    {
        $this->indexService = $indexService;
        $this->appViewmanager = $appViewmanager;
        $this->eventService = $eventService;
        $this->participaService = $participaService;
    }
    
    public function index()
    {
        $global = $this->appViewmanager->index();
        $global['practicados'] = $this->eventService->getUserEventsByLocalidadLimit4();
        $global['noPracticados'] = $this->eventService->getUserEventsNOTPracticadesByLocalidadLimit4();
        $global['participa'] = $this->participaService->userParticipas();
        
        return $global;
    }
}
