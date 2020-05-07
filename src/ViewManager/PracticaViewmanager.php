<?php

namespace App\ViewManager;

use App\Service\IndexService;
use App\ViewManager\AppViewmanager;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Practica;
use App\Form\PracticaType;
use App\Manager\PracticaManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Security;

class PracticaViewmanager extends AbstractController
{
    private $appViewmanager;
    private $security;
    private $practicaManager;

    public function __construct(IndexService $indexService, AppViewmanager $appViewmanager, Security $security, PracticaManager $practicaManager)
    {
        $this->indexService = $indexService;
        $this->appViewmanager = $appViewmanager;
        $this->security = $security;
        $this->practicaManager = $practicaManager;
    }
    
    public function index()
    {
        $global = $this->appViewmanager->index();

        return $global;
    }

    public function new (Request $request)
    {
        $user = $this->security->getUser();
        if(!$user){
            
        }
        $practicados = $this->practicaManager->getDeportesPracticados($user);
        $noPracticados = $this->practicaManager->getDeportesNoPracticados($user);
        $deportes = [] ;
        $deportes['niveles'] = [];
        $deportes['posiciones'] = [];
        foreach($practicados as $practicado)
        {
            $deporte = $practicado->getDeporte()->getId();
            $nivel = $practicado->getNivel()->getId();
            if($practicado->getPosicion()){
                $posicionId = $practicado->getPosicion()->getId();
                $deportes['posiciones'][] = $deporte.'_'.$posicionId;
            }
            
            $deportes['niveles'][] = $deporte.'_'.$nivel;
        
        }
        $global = $this->index();
        $global['practicados'] = $deportes;

        return $global;
    }
}
