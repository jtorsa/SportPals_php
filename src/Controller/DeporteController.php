<?php

namespace App\Controller;

use App\Entity\Deporte;
use App\Form\DeporteType;
use \Gumlet\ImageResize;
use App\Repository\DeporteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

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
            $image = $form->get('Campo')->getData();
            $imageFileName = $form->get('Nombre')->getData().'.'.$image->guessExtension();
            /**Mover a un servicio imagen que se encargue de guardar las imagenes y redimiensionarlas */
            try {
                $image->move(
                    $this->getParameter('court_directory'),
                    $imageFileName
                );
                $imagick = new \Imagick();
                $imagick->readImage($this->getParameter('court_directory').'/'.$imageFileName);
                $imagick->rotateImage(new \ImagickPixel(), 90);
                $imagick->writeImage($this->getParameter('court_directory').'/'.$imageFileName);
                $imagick->clear();
                $imagick->destroy();
            } catch (FileException $e) {
                dump($e->getMessage());die;
                return $e->getMessage();
            }
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
