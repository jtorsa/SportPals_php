<?php

namespace App\Service;

use App\Manager\PracticaManager;
use App\Manager\UsuarioManager;
use App\Repository\DeporteRepository;
use Symfony\Component\Security\Core\Security;

class IndexService
{
    private $security;
    private $practicaManager;
    private $usuarioManager;

    public function __construct(Security $security, DeporteRepository $deporteRepository, PracticaManager $practicaManager, UsuarioManager $usuarioManager)
    {
        $this->security = $security;
        $this->deporteRepository = $deporteRepository;
        $this->practicaManager = $practicaManager;
        $this->usuarioManager = $usuarioManager;
    }

    /* funcion que devuelve todos los deportes */
    public function getDeportes()
    {
        return $this->deporteRepository->findAll();
    }



    /* funcion para recoger los deporte que practica el usuario logueado */
    public function getPracticados()
    {
        $user = $this->security->getUser();

        if($user){
            return $user->getDeportesPracticados();
        }
        return [];
    }

    /* funcion para recoger eventos en su localidad y que practique*/

    public function getEventos(){
        $deportes = $this->getPracticados();

    }

 /* funcion para recoger los deportes que aun NO practica*/
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
        $localidad = $this->security->getUser()->getLocalidad();
        /*Usuarios de la misma localidad */
        $posiblesAmigos = $this->usuarioManager->mismaLocalidad($localidad);
        dump($posiblesAmigos);die;
    }

}
