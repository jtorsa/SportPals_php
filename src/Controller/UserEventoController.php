<?php

namespace App\Controller;

use App\Entity\Evento;
use App\Service\IndexService;
use App\Repository\EventoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\EventoType;
use App\Repository\ParticipaRepository;
use App\ViewManager\AppViewmanager;
use App\ViewManager\EventoViewmanager;
use DateInterval;
use DateTime;

/**
 * @Route("/evento")
 */
class UserEventoController extends AbstractController
{
    private $indexService;
    private $eventoViewmanager;
    private $appViewmanager;


    public function __construct(IndexService $indexService, EventoViewmanager $eventoViewmanager, AppViewmanager $appViewmanager)
    {
        $this->indexService = $indexService;
        $this->appViewmanager = $appViewmanager;
        $this->eventoViewmanager= $eventoViewmanager;
    }

    /**
     * @Route("/", name="evento_index", methods={"GET"})
     */
    public function index(EventoRepository $eventoRepository): Response
    {
        $global = $this->eventoViewmanager->index();
        
        return $this->render('eventouser/index.html.twig', [
            'global' => $global,
        ]);
    }

    /**
     * @Route("/new", name="evento_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $hoy = new DateTime('now');
        $hoy->sub(new DateInterval('P1D'));
        $global = $this->appViewmanager->index();
        $evento = new Evento();
        $evento->setCreador($this->getUser());
        $form = $this->createForm(EventoType::class, $evento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($evento);
            $entityManager->flush();

            return $this->redirectToRoute('evento_index');
        }

        return $this->render('evento/new.html.twig', [
            'global' => $global,
            'evento' => $evento,
            'hoy' => $hoy->format('Y-m-d'),
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}/edit", name="evento_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Evento $evento): Response
    {
        $form = $this->createForm(EventoType::class, $evento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('evento_index');
        }

        return $this->render('evento/edit.html.twig', [
            'evento' => $evento,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="evento_show", methods={"GET"})
     */
    public function show(Evento $evento): Response
    {
        $global = $this->eventoViewmanager->show($evento);
        
        return $this->render('eventouser/show.html.twig', [
            'global' => $global,
        ]);
    }

}
