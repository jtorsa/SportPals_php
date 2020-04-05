<?php

namespace App\Controller;

use App\Entity\Nivel;
use App\Form\Nivel1Type;
use App\Repository\NivelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/nivel")
 */
class NivelController extends AbstractController
{
    /**
     * @Route("/", name="nivel_index", methods={"GET"})
     */
    public function index(NivelRepository $nivelRepository): Response
    {
        return $this->render('nivel/index.html.twig', [
            'nivels' => $nivelRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="nivel_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $nivel = new Nivel();
        $form = $this->createForm(Nivel1Type::class, $nivel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($nivel);
            $entityManager->flush();

            return $this->redirectToRoute('nivel_index');
        }

        return $this->render('nivel/new.html.twig', [
            'nivel' => $nivel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="nivel_show", methods={"GET"})
     */
    public function show(Nivel $nivel): Response
    {
        return $this->render('nivel/show.html.twig', [
            'nivel' => $nivel,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="nivel_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Nivel $nivel): Response
    {
        $form = $this->createForm(Nivel1Type::class, $nivel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('nivel_index');
        }

        return $this->render('nivel/edit.html.twig', [
            'nivel' => $nivel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="nivel_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Nivel $nivel): Response
    {
        if ($this->isCsrfTokenValid('delete'.$nivel->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($nivel);
            $entityManager->flush();
        }

        return $this->redirectToRoute('nivel_index');
    }
}
