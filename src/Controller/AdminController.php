<?php

namespace App\Controller;

use App\ViewManager\AdminViewmanager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class AdminController extends AbstractController
{
    private $adminViewmanager;

    public function __construct(AdminViewmanager $adminViewmanager)
    {
        $this->adminViewmanager = $adminViewmanager;
    }
    /**
     * @Route("/", name="admin_index")
     */
    public function index()
    {
        $global= $this->adminViewmanager->index();

        return $this->render('admin/index.html.twig', array(
            'global' => $global
        ));
    }

}
