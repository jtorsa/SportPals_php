<?php

namespace App\Controller;

use App\Service\AdminService;
use App\ViewManager\AdminViewmanager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Route("/admin")
 */
class AdminController extends AbstractController
{
    private $adminViewmanager;
    private $adminService;

    public function __construct(AdminViewmanager $adminViewmanager, AdminService $adminService)
    {
        $this->adminViewmanager = $adminViewmanager;
        $this->adminService = $adminService;
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

    /**
     * @Route("/template/{id}", name="admin_sport_template", methods={"GET","POST"})
     */
    public function createSportTemplate(Request $request)
    {
        $global= $this->adminViewmanager->index();
        $global['deporteId'] = $request->attributes->get('id');
        return $this->render('admin/sportTemplate.html.twig', array(
            'global' => $global
        ));
    }

    /**
     * @Route("/template/new/", name="admin_ajax_template", methods={"GET","POST"})
     */
    public function createAjaxSportTemplate(Request $request)
    {
        $this->adminService->createTemplate($request);
        
        $global= $this->adminViewmanager->index();
        
        return $this->render('admin/sportTemplate.html.twig', array(
            'global' => $global
        ));
    }

}
