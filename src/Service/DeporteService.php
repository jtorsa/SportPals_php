<?php

namespace App\Service;

use App\Entity\Participa;
use App\Manager\PosicionManager;
use Symfony\Component\Security\Core\Security;
use App\Manager\EventoManager;
use App\Manager\DeporteManager;

class DeporteService
{
    private $security;
    private $posicionManager;
    private $eventoManager;
    private $deporteManager;

    public function __construct(DeporteManager $deporteManager, Security $security, PosicionManager $posicionManager, EventoManager $eventoManager)
    {
        $this->security = $security;
        $this->posicionManager = $posicionManager;
        $this->eventoManager = $eventoManager;
        $this->deporteManager = $deporteManager;
    }

    public function getMostPracticeds()
    {
        $deportes = $this->deporteManager->getMostPracticeds();
        
        return$deportes;
    }

}
