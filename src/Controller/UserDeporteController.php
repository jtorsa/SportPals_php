<?php

namespace App\Controller;

use App\Entity\Deporte;
use App\Repository\DeporteRepository;
use App\Repository\NivelRepository;
use App\Repository\PosicionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\IndexService;
use App\ViewManager\AppViewmanager;

/**
 * @Route("/deporte")
 */
class UserDeporteController extends AbstractController
{
    private $indexService;
    private $appViewmanager;
    private $posicionRepository;
    private $nivelRepository;

    public function __construct(IndexService $indexService, AppViewmanager $appViewmanager, PosicionRepository $posicionRepository, NivelRepository $nivelRepository)
    {
        $this->indexService = $indexService;
        $this->appViewmanager = $appViewmanager;
        $this->nivelRepository = $nivelRepository;
        $this->posicionRepository = $posicionRepository;
    }

    /**
     * @Route("/", name="deporte_index", methods={"GET"})
     */
    public function index(DeporteRepository $deporteRepository): Response
    {
        $global = $this->appViewmanager->index();
        return $this->render('deporteuser/index.html.twig', [
            'global' => $global,
        ]);
    }

    /**
     * @Route("/{id}", name="deporte_show", methods={"GET"})
     */
    public function show(Deporte $deporte): Response
    {
        $global = $this->appViewmanager->index();
        $global['deporte'] = $deporte;
        $global['posiciones']= $this->posicionRepository->findBy(['deporte'=> $deporte->getId()]);
        $global['niveles']= $this->nivelRepository->findBy(['deporte'=> $deporte->getId()]);
        
        return $this->render('deporteuser/show.html.twig', [
            'global' => $global
        ]);
    }

}
