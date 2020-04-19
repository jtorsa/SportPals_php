<?php

namespace App\Controller;

use App\ViewManager\IndexViewmanager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    private $indexViewmanager;

    public function __construct(IndexViewmanager $indexViewmanager)
    {
        $this->indexViewmanager = $indexViewmanager;
    }
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->render('base.html.twig', [
            
            'global' => $this->indexViewmanager->index()
            ]);
    }

}
