<?php

namespace App\Controller;

use App\Repository\UsuarioRepository;
use App\Repository\VotacionRepository;
use App\Entity\Votacion;
use App\Repository\EventoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

/**
 * @Route("/valoracion")
 */
class ValoracionController extends AbstractController
{

    private $votacionRepository;
    private $security;
    private $usuarioRepository;
    private $eventoRepository;

    public function __construct(VotacionRepository $votacionRepository, Security $security, UsuarioRepository $usuarioRepository, EventoRepository $eventoRepository)
    {
        $this->votacionRepository = $votacionRepository;
        $this->security = $security;
        $this->usuarioRepository = $usuarioRepository;
        $this->eventoRepository = $eventoRepository;
    }
    /**
     * @Route("/new", name="valoracion_new_ajax", methods={"POST"})
     */
    public function new(Request $request)
    {
        $parameters = $request->request;
        $user = $this->security->getUser();
        $entityManager = $this->getDoctrine()->getManager();

        foreach($parameters as $key => $value){
            $data = explode('_',$value);
            $jugador = $this->usuarioRepository->findOneBy(['avatar'=> $data[0]]);
            $evento = $this->eventoRepository->find($data[2]);
            $votacion = $this->votacionRepository->findBy([
                'usuario' => $user->getId(),
                'jugador' => $jugador->getId(),
                'evento' => $data[2]
            ]);
            if(empty($votacion)){
                $votacion = new Votacion();
                $votacion->setUsuario($user);
                $votacion->setJugador($jugador);
                $votacion->setValor($data[1]);
                $votacion->setEvento($evento);
            }else{
                $votacion= $votacion[0];
                $votacion->setValor($data[1]);
            }
        }
        $entityManager->persist($votacion);
        $entityManager->flush();

        return $this->redirectToRoute('evento_show',['id'=>$data[2]]);
    }
}
