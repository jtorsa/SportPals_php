<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\LocalidadRepository;

class LocalidadController extends AbstractController
{
    /**
     * @Route("/localidad", name="localidad")
     */
    public function index(LocalidadRepository $localidadRepository)
    {

        $localidades = $localidadRepository->findAll();
        return $this->render('localidad/index.html.twig', [
            'controller_name' => 'LocalidadController',
            'localidades' => $localidades
        ]);
    }
}
