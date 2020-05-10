<?php

namespace App\Controller;

use App\Entity\Participa;
use App\Form\ParticipaType;
use App\Service\ParticipaService;
use App\Repository\ParticipaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/participa")
 */
class ParticipaController extends AbstractController
{
    private $participaService;

    public function __construct(ParticipaService $participaService)
    {
        $this->participaService = $participaService;
    }
    /**
     * @Route("/", name="participa_index", methods={"GET"})
     */
    public function index(ParticipaRepository $participaRepository): Response
    {
        return $this->render('participa/index.html.twig', [
            'participas' => $participaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="participa_new_ajax", methods={"GET","POST"})
     */
    public function newAjax(Request $request): Response
    {   
        $participa = $this->participaService->getParticipaFromAjax($request->request->get('id'), $request->request->get('posicion'));
        $evento = $participa->getEvento()->getId();
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($participa);
        $entityManager->flush();

        return $this->redirectToRoute('evento_show',['id'=>$evento]);
    }

    /**
     * @Route("/new", name="participa_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $participa = new Participa();
        $form = $this->createForm(ParticipaType::class, $participa);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($participa);
            $entityManager->flush();

            return $this->redirectToRoute('participa_index');
        }

        return $this->render('participa/new.html.twig', [
            'participa' => $participa,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="participa_show", methods={"GET"})
     */
    public function show(Participa $participa): Response
    {
        return $this->render('participa/show.html.twig', [
            'participa' => $participa,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="participa_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Participa $participa): Response
    {
        $form = $this->createForm(ParticipaType::class, $participa);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('participa_index');
        }

        return $this->render('participa/edit.html.twig', [
            'participa' => $participa,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="participa_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Participa $participa): Response
    {
        if ($this->isCsrfTokenValid('delete'.$participa->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($participa);
            $entityManager->flush();
        }

        return $this->redirectToRoute('participa_index');
    }
}
