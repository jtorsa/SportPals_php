<?php

namespace App\Service;

use App\Entity\Practica;
use App\Repository\DeporteRepository;
use App\Repository\NivelRepository;
use App\Repository\PosicionRepository;
use App\Repository\PracticaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\Security\Core\Security;


class PracticaService extends AbstractController
{
    private $security;
    private $practicaRepository;
    private $deporteRepository;
    private $nivelRepository;
    private $posicionRepository;

    public function __construct(
        Security $security, 
        PracticaRepository $practicaRepository, 
        DeporteRepository $deporteRepository, 
        NivelRepository $nivelRepository,
        PosicionRepository $posicionRepository)
    {
        $this->security = $security;
        $this->practicaRepository = $practicaRepository;
        $this->deporteRepository = $deporteRepository;
        $this->nivelRepository = $nivelRepository;
        $this->posicionRepository = $posicionRepository;
    }

    public function updateParticipas(ParameterBag $parameters)
    {
        $user = $this->security->getUser();
        $practicas = [];
        foreach($parameters as $key => $value){
            if($value !== ''){
                $data = explode('_', $value);
                $practicas[$data[0]][] = $data[1];
            }           
        }
        $entityManager = $this->getDoctrine()->getManager();
        foreach($practicas as $deporte =>$value){
            $practica = $this->practicaRepository->findOneBy(['jugador'=>$user->getId(),'deporte'=>$deporte]);
            $deporte = $this->deporteRepository->find($deporte);
            $nivel = $this->nivelRepository->find($value[0]);
            if(2===count($value)){
                $posicion = $this->posicionRepository->find($value[1]);
                if($practica){
                    $practica->setPosicion($posicion);
                    $practica->setNivel($nivel);
                }else{
                    $practica = New Practica();
                    $practica->setNivel($nivel);
                    $practica->setPosicion($posicion);
                    $practica->setDeporte($deporte);
                    $practica->setJugador($user);
                }
            }else{
                if($practica){
                    $practica->setNivel($nivel);
                }else{
                    $practica = New Practica();
                    $practica->setDeporte($deporte);
                    $practica->setNivel($nivel);
                    $practica->setJugador($user);
                }
            }
            $entityManager->persist($practica);
        }
        $entityManager->flush();

        return $this->redirectToRoute('participa_index');
    }

}
