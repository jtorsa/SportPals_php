<?php

namespace App\Controller;

use App\Entity\Evento;
use App\Form\EventoType;
use App\Repository\EventoRepository;
use Intervention\Image\ImageManagerStatic as Image;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\ViewManager\EventoViewmanager;
use DateTime;
use DateInterval;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

/**
 * @Route("/admin/event")
 */
class EventoController extends AbstractController
{

    private $eventoViewmanager;

    public function __construct(EventoViewmanager $eventoViewmanager)
    {
        $this->eventoViewmanager= $eventoViewmanager;
    }

    /**
     * @Route("/", name="admin_evento_index", methods={"GET"})
     */
    public function index(EventoRepository $eventoRepository): Response
    {
        
        return $this->render('evento/index.html.twig', [
            'eventos' => $eventoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_evento_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        dump(0);die;
        $evento = new Evento();
        $evento->setCreador($this->getUser());
        $form = $this->createForm(EventoType::class, $evento);
        $form->handleRequest($request);        

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $image = $form->get('image')->getData();
            $imageFileName = $form->get('title')->getData().$form->get('dia')->getData().'.png';
            try {
                $image->move(
                    $this->getParameter('event_directory'),
                $imageFileName
                );
                $img = Image::make($this->getParameter('event_directory').'/'.$imageFileName);
                $img->resize(450, 700);
                $img->save($this->getParameter('event_directory').'/'.$imageFileName);
            }catch (FileException $e) {
                dump($e->getMessage());die;
                    $e->getMessage();
               }
               $evento->setImage($imageFileName);
dump($evento);die;
            $entityManager->persist($evento);
            $entityManager->flush();

            return $this->redirectToRoute('evento_index');
        }

        return $this->render('evento/new.html.twig', [
            'evento' => $evento,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_evento_show", methods={"GET"})
     */
    public function show(Evento $evento): Response
    {
        return $this->render('evento/show.html.twig', [
            'evento' => $evento,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_evento_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Evento $evento): Response
    {
        $hoy = new DateTime('now');
        $hoy->sub(new DateInterval('P1D'));
        $form = $this->createForm(EventoType::class, $evento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('evento_index');
        }

        return $this->render('evento/edit.html.twig', [
            'hoy' => $hoy,
            'evento' => $evento,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="evento_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Evento $evento): Response
    {
        if ($this->isCsrfTokenValid('delete'.$evento->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($evento);
            $entityManager->flush();
        }

        return $this->redirectToRoute('evento_index');
    }
}
