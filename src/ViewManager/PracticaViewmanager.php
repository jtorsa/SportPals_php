<?php

namespace App\ViewManager;

use App\Service\IndexService;
use App\ViewManager\AppViewmanager;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Practica;
use App\Form\PracticaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Security;

class PracticaViewmanager extends AbstractController
{
    private $appViewmanager;
    private $security;

    public function __construct(IndexService $indexService, AppViewmanager $appViewmanager, Security $security)
    {
        $this->indexService = $indexService;
        $this->appViewmanager = $appViewmanager;
        $this->security = $security;
    }
    
    public function index()
    {
        $global = $this->appViewmanager->index();

        return $global;
    }

    public function new (Request $request)
    {
        $practica = new Practica();
        $practica->setJugador($this->security->getUser());
        $form = $this->createForm(PracticaType::class, $practica);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($practica);
            $entityManager->flush();

            return $this->redirectToRoute('practica_index');
        }
        $global = $this->index();
        $global['practica'] = $practica;
        $global['form'] = $form->createView();

        return $global;
    }
}
