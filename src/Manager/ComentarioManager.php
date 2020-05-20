<?php

namespace App\Manager;

use App\Entity\Evento;
use App\Repository\ComentarioRepository;

class ComentarioManager

{
    private $managerRepository;
    
    public function __construct(ComentarioRepository $comentarioRepository)
    {
        $this->comentarioRepository = $comentarioRepository;
    }

    public function getDeportesNoPracticados()
    {
    }

    public function findAll()
    {
        return $this->comentarioRepository->findAll();
    }

    public function getEventComments(Evento $evento)
    {
        return $this->comentarioRepository->findBy(['evento'=>$evento->getId()]);
    }
}