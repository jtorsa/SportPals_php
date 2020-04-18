<?php

namespace App\Controller;

use App\Entity\Evento;
use App\Service\IndexService;
use App\Repository\EventoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/evento")
 */
class UserEventoController extends AbstractController
{
    private $indexService;

    public function __construct(IndexService $indexService)
    {
        $this->indexService = $indexService;
    }

    /**
     * @Route("/", name="evento_index", methods={"GET"})
     */
    public function index(EventoRepository $eventoRepository): Response
    {
        $deportes = $this->indexService->getDeportes();
        return $this->render('eventouser/index.html.twig', [
            'eventos' => $eventoRepository->findAll(),
            'deportes' => $deportes
        ]);
    }

    /**
     * @Route("/{id}", name="evento_show", methods={"GET"})
     */
    public function show(Evento $evento): Response
    {
        return $this->render('eventouser/show.html.twig', [
            'evento' => $evento,
        ]);
    }

}
