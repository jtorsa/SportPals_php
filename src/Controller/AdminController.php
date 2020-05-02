<?php

namespace App\Controller;

use App\ViewManager\AdminViewmanager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\Material\ColumnChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\Diff\DiffColumnChart;

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
        $this->adminViewmanager->index();
        $global= $this->adminViewmanager->index();
        
        return $this->render('admin/index.html.twig', array(
            'global' => $global
        ));
    }

}
