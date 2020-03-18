<?php

namespace App\Controller;

use App\Entity\Evento;
use App\Repository\EventoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/evento")
 */
class UserEventoController extends AbstractController
{
    /**
     * @Route("/", name="evento_index", methods={"GET"})
     */
    public function index(EventoRepository $eventoRepository): Response
    {
        return $this->render('eventouser/index.html.twig', [
            'eventos' => $eventoRepository->findAll(),
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
