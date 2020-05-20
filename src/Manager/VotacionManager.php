<?php

namespace App\Manager;

use App\Entity\Deporte;
use App\Repository\VotacionRepository;
use App\Entity\Evento;
use App\Entity\Usuario;

class VotacionManager

{
    
    private $votacionRepository;

    public function __construct(VotacionRepository $votacionRepository)
    {
        $this->votacionRepository = $votacionRepository;
    }

    public function getVotesByEvent(Usuario $usuario, Evento $evento)
    {
        return $this->votacionRepository->findBy([
            'jugador'=>$usuario->getId(),
            'evento' => $evento->getId()
            ]);
    }

    public function getVotesBySport(Usuario $usuario, Deporte $deporte)
    {
        
    }

    public function getVotesByUser(Usuario $usuario)
    {
        return $this->votacionRepository->findBy(['jugador'=>$usuario->getId()]);
    }
}