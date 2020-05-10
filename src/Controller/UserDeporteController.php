<?php

namespace App\Controller;

use App\Entity\Deporte;
use App\Repository\DeporteRepository;
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

    public function __construct(IndexService $indexService, AppViewmanager $appViewmanager)
    {
        $this->indexService = $indexService;
        $this->appViewmanager = $appViewmanager;
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
        return $this->render('deporteuser/show.html.twig', [
            'deportes' => $this->indexService->getDeportes(),
            'deporte' => $deporte
        ]);
    }

}
