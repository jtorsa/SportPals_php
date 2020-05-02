<?php

namespace App\Service;

use App\Entity\Participa;
use App\Manager\PosicionManager;
use Symfony\Component\Security\Core\Security;
use App\Manager\EventoManager;
use App\Manager\ParticipaManager;

class ParticipaService
{
    private $security;
    private $posicionManager;
    private $eventoManager;
    private $participaManager;

    public function __construct(Security $security, PosicionManager $posicionManager, EventoManager $eventoManager, ParticipaManager $participaManager)
    {
        $this->security = $security;
        $this->posicionManager = $posicionManager;
        $this->eventoManager = $eventoManager;
        $this->participaManager = $participaManager;
    }

    public function getParticipaFromAjax(string $event, string $posTeam) : Participa
    {
        $posTeam = explode('-',$posTeam);
        $posicion = $this->posicionManager->getByName($posTeam[0]);
        $user = $this->security->getUser();
        $event = $this->eventoManager->getById($event);

        $participa = new Participa;
        $participa->setJugador($user);
        $participa->setPosicion($posicion);
        $participa->setEvento($event);
        $participa->setEquipo($posTeam[1]);

        return $participa;
    }

    public function getMostActiveCities()
    {
        return $this->participaManager->getMostActiveCities();
    }

}
