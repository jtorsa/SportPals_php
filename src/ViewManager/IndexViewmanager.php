<?php

namespace App\ViewManager;

use App\Service\IndexService;
use App\ViewManager\AppViewmanager;
use App\Service\EventService;

class IndexViewmanager
{
    private $indexService;
    private $appViewmanager;
    private $eventService;

    public function __construct(IndexService $indexService, EventService $eventService, AppViewmanager $appViewmanager)
    {
        $this->indexService = $indexService;
        $this->appViewmanager = $appViewmanager;
        $this->eventService = $eventService;
    }
    
    public function index()
    {
        $global = $this->appViewmanager->index();
        $global['practicados'] = $this->eventService->getUserEventsByLocalidadLimit4();
        $global['noPracticados'] = $this->eventService->getUserEventsNOTPracticadesByLocalidadLimit4();

        return $global;
    }
}
