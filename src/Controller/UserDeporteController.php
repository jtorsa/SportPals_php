<?php

namespace App\Controller;

use App\Entity\Deporte;
use App\Repository\DeporteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\IndexService;

/**
 * @Route("/deporte")
 */
class UserDeporteController extends AbstractController
{
    private $indexService;

    public function __construct(IndexService $indexService)
    {
        $this->indexService = $indexService;
    }

    /**
     * @Route("/", name="deporte_index", methods={"GET"})
     */
    public function index(DeporteRepository $deporteRepository): Response
    {
        return $this->render('deporteuser/index.html.twig', [
            'deportes' => $deporteRepository->findAll(),
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
