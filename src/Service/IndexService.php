<?php

namespace App\Service;

use App\Manager\PracticaManager;
use App\Repository\DeporteRepository;
use Symfony\Component\Security\Core\Security;

class IndexService
{
    private $security;
    private $deporteRepository;
    private $practicaManager;

    public function __construct(Security $security, DeporteRepository $deporteRepository, PracticaManager $practicaManager)
    {
        $this->security = $security;
        $this->deporteRepository = $deporteRepository;
        $this->practicaManager = $practicaManager;
    }
    /* funcion para recoger eventos en su localidad y que practique*/


    /* funcion para recoger los deportes que aun NO practica*/

    /* funcion para recoger los deporte que practica el usuario logueado */
    public function getPracticados()
    {
        $user = $this->security->getUser();

        if($user){
            return $user->getDeportesPracticados();
        }
        return [];
    }

    public function getDeportesNoPracticados()
    {
        $user = $this->security->getUser();
        if(!$user){
            return [];
        }
        return $this->practicaManager->getDeportesNoPracticados($user);
    }

    public function getPosibleAmistad()
    {
        $user = $this->security->getUser()->getLocalidad();
        /*Usuarios de la misma localidad */
    }
}
