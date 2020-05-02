<?php

namespace App\ViewManager;

use App\Service\IndexService;
use App\ViewManager\AppViewmanager;
use App\Service\EventService;
use App\Service\DeporteService;
use App\Service\ParticipaService;
use App\Service\UsuarioService;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\Material\ColumnChart;

class AdminViewmanager
{
    private $indexService;
    private $appViewmanager;
    private $eventService;
    private $deporteService;
    private $participaService;
    private $usuarioService;

    public function __construct(DeporteService $deporteService, IndexService $indexService, EventService $eventService, AppViewmanager $appViewmanager, ParticipaService $participaService, UsuarioService $usuarioService)
    {
        $this->deporteService = $deporteService;
        $this->indexService = $indexService;
        $this->appViewmanager = $appViewmanager;
        $this->eventService = $eventService;
        $this->participaService = $participaService;
        $this->usuarioService = $usuarioService;
    }
    
    public function index()
    {
        $global['mostPracticeds'] = $this->getMostPracticeds();
        $global['mostActive'] = $this->getMostActiveCities();
        $global['mostUsers'] = $this->getMostUsersCities();

        return $global;
    }

    public function getMostPracticeds()
    {
        $deportes = $this->deporteService->getMostPracticeds();
        $practicados = [];
        $practicados[] = ['Deporte', 'Practicantes'];
        foreach($deportes as $deporte){
            $practicados[] = [
                $deporte['nombre'],
                intval($deporte['num'])
            ];
        };
        return $this->createColumnChart($practicados);
    }

    public function getMostActiveCities()
    {
        $localidades = $this->participaService->getMostActiveCities();
        $practicados = [];
        $practicados[] = ['Ciudad', 'eventos'];
        foreach($localidades as $localidad){
            $practicados[] = [
                $localidad['Nombre'],
                intval($localidad['num'])
            ];
        };
        return $this->createColumnChart($practicados);
    }

    public function getMostUsersCities()
    {
        $usuarios = $this->usuarioService->getMostUsersCities();
        $practicados = [];
        $practicados[] = ['Ciudad', 'usuarios'];
        foreach($usuarios as $usuario){
            $practicados[] = [
                $usuario['Nombre'],
                intval($usuario['num'])
            ];
        };
        return $this->createColumnChart($practicados);
    }

    public function createColumnChart(array $data)
    {
        $oldColumnChart = new ColumnChart();
        $oldColumnChart->getData()->setArrayToDataTable(
            $data
        );
        $oldColumnChart->getOptions()->getLegend()->setPosition('top');
        $oldColumnChart->getOptions()->setWidth(450);
        $oldColumnChart->getOptions()->setHeight(250);

        return $oldColumnChart;
    }
}
