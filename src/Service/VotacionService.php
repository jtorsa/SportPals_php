<?php

namespace App\Service;

use App\Entity\Evento;
use App\Entity\Usuario;
use App\Manager\VotacionManager;
use App\Repository\UsuarioRepository;
use Symfony\Component\Security\Core\Security;

class VotacionService
{

    private $votacionManager;
    private $usuarioRepository;
    private $security;

    public function __construct(VotacionManager $votacionManager, Security $security, UsuarioRepository $usuarioRepository)
    {
        $this->votacionManager = $votacionManager;
        $this->security = $security;
        $this->usuarioRepository = $usuarioRepository;
    }

    public function getAverageRateByEvent(array $participantes, Evento $evento)
    {
        $votos = [];

        foreach($participantes as $posicion => $avatar){

            $usuario = $this->usuarioRepository->findOneBy(['avatar' => $avatar]);
            $rates = $this->votacionManager->getVotesByEvent( $usuario,  $evento);
            $puntuacion = 0;
            if(empty($rates)){
                continue;
            }
            foreach($rates as $rate){
                $puntuacion += $rate->getValor();
            }
            $average = intval($puntuacion/count($rates));
            
            $votos[$avatar] = $average;
        }

        return $votos;    
    }
}