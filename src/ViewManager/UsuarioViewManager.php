<?php

namespace App\ViewManager;

use App\Entity\Usuario;
use App\ViewManager\AppViewmanager;

class UsuarioViewManager
{

    private $appViewmanager;

    public function __construct(AppViewmanager $appViewmanager)
    {

        $this->appViewmanager = $appViewmanager;
    }
    
    public function index()
    {
        $global = $this->appViewmanager->index();
       
        return $global;
    }

    public function show(Usuario $usuario)
    {
        $global = $this->appViewmanager->index();
        $global['usuario'] = $usuario;
        
        return $global;
    }
}
