<?php

namespace App\Manager;

use App\Repository\PosicionRepository;

class PosicionManager 
{

    private $posicionRepository;
    
    public function __construct( PosicionRepository $posicionRepository)
    {
        $this->posicionRepository = $posicionRepository;
    }

    public function getByName(string $name)
    {
        return $this->posicionRepository->findOneBy(['nombre'=>$name]);
    }
}