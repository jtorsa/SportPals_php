<?php

namespace App\ViewManager;

use App\Service\IndexService;

class AppViewmanager
{
    private $indexService;

    public function __construct(IndexService $indexService)
    {
        $this->indexService = $indexService;
    }
    
    public function index()
    {
        $global = 
       [
           'deportes' => $this->indexService->getDeportes(),
        ];
        return $global;
    }
}
