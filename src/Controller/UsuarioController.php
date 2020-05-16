<?php

namespace App\Controller;

use App\Entity\Usuario;
use App\EventSubscriber\CalendarSubscriber;
use App\Form\UsuarioType;
use App\Repository\UsuarioRepository;
use App\ViewManager\UsuarioViewManager;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/usuario")
 */
class UsuarioController extends AbstractController
{
    private $usuarioViewManager;
    private $calendarSubscriber;

    public function __construct(UsuarioViewManager $usuarioViewManager, CalendarSubscriber $calendarSubscriber)
    {
        $this->usuarioViewManager = $usuarioViewManager;
        $this->calendarSubscriber = $calendarSubscriber;
    }
    /**
     * @Route("/", name="usuario_index", methods={"GET"})
     */
    public function index(UsuarioRepository $usuarioRepository): Response
    {
        return $this->render('usuario/index.html.twig', [
            'usuarios' => $usuarioRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="usuario_new", methods={"GET","POST"})
     */
    public function new(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $usuario = new Usuario();
        $form = $this->createForm(UsuarioType::class, $usuario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $image = $form->get('avatar')->getData();
            $imageFileName = $form->get('email')->getData().'.'.$image->guessExtension();
            $usuario->setAvatar($imageFileName);
            $usuario->setFechaAlta(new DateTime('now'));
            $usuario->setRoles(["ROLE_USER"]);
            $usuario->setPassword($passwordEncoder->encodePassword(
                $usuario,
                $form->get('password')->getData()
            ));
            try {
                $image->move(
                    $this->getParameter('avatar_directory'),
                    $imageFileName
                );
            } catch (FileException $e) {
                dump($e->getMessage());die;
                return $e->getMessage();
            }
            
            $entityManager->persist($usuario);
            $entityManager->flush();

            return $this->redirectToRoute('index');
        }
        return $this->render('usuario/new.html.twig', [
            'usuario' => $usuario,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="usuario_show", methods={"GET"})
     */
    public function show(Usuario $usuario): Response
    {
        $eventos = [
            "title" => "Event 1",
            "start" => "2020-05-16 10:38:34.122943",
            "end" => "2020-05-16 11:38:34.122943"
        ];
        
        
        $global = $this->usuarioViewManager->show($usuario);
        $global['eventos'] = json_encode($eventos);
        return $this->render('usuario/show.html.twig', [
            'global' => $global,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="usuario_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Usuario $usuario): Response
    {
        $form = $this->createForm(UsuarioType::class, $usuario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('usuario_index');
        }

        return $this->render('usuario/edit.html.twig', [
            'usuario' => $usuario,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="usuario_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Usuario $usuario): Response
    {
        if ($this->isCsrfTokenValid('delete'.$usuario->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($usuario);
            $entityManager->flush();
        }

        return $this->redirectToRoute('usuario_index');
    }

}
