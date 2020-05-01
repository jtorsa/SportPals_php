<?php

namespace App\Controller;

use App\ViewManager\IndexViewmanager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class AdminController extends AbstractController
{
    private $indexViewmanager;

    public function __construct(IndexViewmanager $indexViewmanager)
    {
        $this->indexViewmanager = $indexViewmanager;
    }
    /**
     * @Route("/", name="admin_index")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig');
    }

}
