<?php

namespace App\Controller;

use App\Entity\Deporte;
use App\Form\DeporteType;
use App\Repository\DeporteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/deporte")
 */
class DeporteController extends AbstractController
{
    /**
     * @Route("/", name="admin_deporte_index", methods={"GET"})
     */
    public function index(DeporteRepository $deporteRepository): Response
    {
        return $this->render('deporte/admin_index.html.twig', [
            'deportes' => $deporteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_deporte_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $deporte = new Deporte();
        $form = $this->createForm(DeporteType::class, $deporte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($deporte);
            $entityManager->flush();

            return $this->redirectToRoute('admin_deporte_index');
        }

        return $this->render('deporte/admin_new.html.twig', [
            'deporte' => $deporte,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_deporte_show", methods={"GET"})
     */
    public function show(Deporte $deporte): Response
    {
        return $this->render('deporte/admin_show.html.twig', [
            'deporte' => $deporte,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_deporte_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Deporte $deporte): Response
    {
        $form = $this->createForm(DeporteType::class, $deporte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_deporte_index');
        }

        return $this->render('deporte/admin_edit.html.twig', [
            'deporte' => $deporte,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_deporte_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Deporte $deporte): Response
    {
        if ($this->isCsrfTokenValid('delete' . $deporte->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($deporte);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_deporte_index');
    }
}
