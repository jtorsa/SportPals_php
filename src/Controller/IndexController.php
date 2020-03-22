<?php

namespace App\Controller;

use App\Service\IndexService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    private $indexService;

    public function __construct(IndexService $indexService)
    {
        $this->indexService = $indexService;
    }
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        
        return $this->render('base.html.twig', [
            'practicados' => $this->indexService->getPracticados(),
            'noPracticados' => $this->indexService->getDeportesNoPracticados()
            ]);
    }

}
