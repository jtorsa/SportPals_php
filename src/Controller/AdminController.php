<?php

namespace App\Controller;

use App\Repository\DeporteRepository;
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
    private $deporteRepository;

    public function __construct(AdminViewmanager $adminViewmanager, AdminService $adminService, DeporteRepository $deporteRepository)
    {
        $this->adminViewmanager = $adminViewmanager;
        $this->adminService = $adminService;
        $this->deporteRepository = $deporteRepository;
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
        $requeridos = (string)$this->deporteRepository->find($global['deporteId'])->getRequeridos();
        $global['requeridos'] = $requeridos;
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
