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

    public function unrollFromAjax(string $event, string $user) 
    {
        return $this->participaManager->getParticipaByUserEvent($user, $event);
    }

    public function getMostActiveCities()
    {
        return $this->participaManager->getMostActiveCities();
    }

    public function userParticipas()
    {
        $user =$this->security->getUser();
        $participas = [];
        if($user){
            $participas = $this->participaManager->userParticipas($user);
        }
        
        return $participas;
    }

    public function getPlayersByEvent()
    {
        $playersCount = $this->participaManager->getPlayersByEvent();
        $eventos = $this->eventoManager->findAll();
        $eventsIndexedByCount = [];
        $i = 0;
        foreach($eventos as $evento){
            $done = false;
            foreach($playersCount as $count => $id){
                if($done === false){
                    if($evento->getId() == $id['id']){                   
                        $eventsIndexedByCount[$evento->getId()]['count'] = $id['num'];
                        $eventsIndexedByCount[$evento->getId()]['evento'] = $evento;
                        $done = true;
                    }else{
                        $eventsIndexedByCount[$evento->getId()]['count'] = 0;
                        $eventsIndexedByCount[$evento->getId()]['evento'] = $evento;
                    }
                }
            }
        }
        return $eventsIndexedByCount;
    }
}
