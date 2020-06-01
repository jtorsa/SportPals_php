<?php

namespace App\Service;

use App\Entity\Comentario;
use App\Repository\EventoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Security;

class ComentarioService extends AbstractController
{

    private $eventoRepository;
    private $security;

    public function __construct(EventoRepository $eventoRepository, Security $security)
    {
        $this->eventoRepository = $eventoRepository;
        $this->security = $security;
    }

    public function addComment(array $param)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $evento = $this->eventoRepository->find($param['event_id']);
        $user = $this->security->getUser();
        if($param['comment'] !== ''){
            $comentario = new Comentario;
            $comentario->setMensaje($param['comment']);
            $comentario->setEvento($evento);
            $comentario->setUsuario($user);
    
            $entityManager->persist($comentario);
            
            $entityManager->flush();
        }
    }
}