<?php

namespace App\ViewManager;

use App\Service\IndexService;
use App\ViewManager\AppViewmanager;

class SecurityViewmanager
{
    private $appViewmanager;

    public function __construct( AppViewmanager $appViewmanager)
    {
        $this->appViewmanager = $appViewmanager;
    }
    
    public function index()
    {
        $global = $this->appViewmanager->index();

        return $global;
    }
}
