<?php

namespace App\ViewManager;

use App\Service\IndexService;
use Symfony\Component\Security\Core\Security;

class AppViewmanager
{
    private $indexService;
    private $security;

    public function __construct(IndexService $indexService, Security $security)
    {
        $this->indexService = $indexService;
        $this->security = $security;
    }
    
    public function index()
    {
        $global = 
       [   
           'deportes' => $this->indexService->getDeportes(),
           'loged' => $this->getUser()
        ];
        return $global;
    }

    public function getUser()
    {
        $user = $this->security->getUser();
        if(!$user){
            return false;
        }

        return true;
    }
}
