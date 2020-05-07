<?php

namespace App\Controller;

use App\Entity\Practica;
use App\Form\DeporteType;
use App\Form\PracticaType;
use App\Repository\PracticaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use App\ViewManager\PracticaViewmanager;
use App\ViewManager\AppViewmanager;
use App\Manager\DeporteManager;
use App\Manager\PracticaManager;
use App\Service\PracticaService;

/**
 * @Route("/practica")
 */
class PracticaController extends AbstractController
{
    private $security;
    private $practicaViewmanager;
    private $deporteManager;
    private $practicaService;
    
    public function __construct(Security $security, PracticaViewmanager $practicaViewmanager, DeporteManager $deporteManager, PracticaService $practicaService)
    {
        $this->security = $security;
        $this->practicaViewmanager = $practicaViewmanager;
        $this->deporteManager = $deporteManager;
        $this->practicaService = $practicaService;
    }

    /**
     * @Route("/", name="practica_index", methods={"GET"})
     */
    public function index(PracticaRepository $practicaRepository): Response
    {
        return $this->render('practica/index.html.twig', [
            'practicas' => $practicaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="practica_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        
        $global = $this->practicaViewmanager->new($request);
        $global['deportes'] = $this->deporteManager->findAll();

        return $this->render('practica/new.html.twig', [
            'global' => $global
        ]);

    }

    /**
     * @Route("/newAjax", name="practica_new_ajax", methods={"POST"})
     */
    public function newAjax(Request $request): Response
    {
        $parameters = $request->request;

        $this->practicaService->updateParticipas($parameters);
        
        $global = $this->practicaViewmanager->new($request);
        $global['deportes'] = $this->deporteManager->findAll();
        return $this->render('practica/new.html.twig', [
            'global' => $global
        ]);

    }

    /**
     * @Route("/{id}", name="practica_show", methods={"GET"})
     */
    public function show(Practica $practica): Response
    {
        return $this->render('practica/show.html.twig', [
            'practica' => $practica,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="practica_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Practica $practica): Response
    {
        $form = $this->createForm(PracticaType::class, $practica);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('practica_index');
        }

        return $this->render('practica/edit.html.twig', [
            'practica' => $practica,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="practica_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Practica $practica): Response
    {
        if ($this->isCsrfTokenValid('delete'.$practica->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($practica);
            $entityManager->flush();
        }

        return $this->redirectToRoute('practica_index');
    }
}
