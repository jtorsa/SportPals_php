<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\DeporteRepository;
use App\Entity\Deporte;

class DeporteController extends AbstractController
{
    /**
     * @Route("/deporte", name="deporte_list")
     */
    public function index(DeporteRepository $deporteRepository)
    {
        $deportes = $deporteRepository->findAll();
         if (!$deportes) {
            throw $this->createNotFoundException(
                'No se han encontrado deportes'
            );
    }
        return $this->render('deporte/index.html.twig', [
            'controller_name' => 'DeporteController',
            'deportes' => $deportes
        ]);
    }

    /**
     * @Route("deporte/{id}", name="deporte_detail")
     */
    public function detail(DeporteRepository $deporteRepository, int $id)
    {
        $deporte = $deporteRepository->find($id);

        return $this->render('deporte/detail.html.twig', [
            'controller_name' => 'DeporteController',
            'deporte' => $deporte
        ]);
    }
}
