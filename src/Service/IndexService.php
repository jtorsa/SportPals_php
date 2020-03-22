<?php

namespace App\Service;

use App\Repository\DeporteRepository;
use Symfony\Component\Security\Core\Security;

class IndexService
{
    private $security;
    private $deporteRepository;

    public function __construct(Security $security, DeporteRepository $deporteRepository)
    {
        $this->security = $security;
        $this->deporteRepository = $deporteRepository;
    }
    /* funcion para recoger eventos en su localidad y que practique*/


    /* funcion para recoger los deportes que aun NO practica*/

    /* funcion para recoger los deporte que practica el usuario logueado */
    public function getPracticados()
    {
        $user = $this->security->getUser();
        $this->deporteRepository->getNoPracticados($user);die;

        if($user){
            return $user->getDeportesPracticados();
        }
    }

}
