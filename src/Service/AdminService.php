<?php

namespace App\Service;

use App\Entity\Comentario;
use App\Repository\DeporteRepository;
use App\Repository\EventoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;

class AdminService extends AbstractController
{


    private $security;
    private $deporteRepository;

    public function __construct( Security $security, DeporteRepository $deporteRepository)
    {
        $this->deporteRepository = $deporteRepository;
        $this->security = $security;
    }

    public function createTemplate(Request $request)
    {
        
        $param = $request->request;
        $deporte = null;
        foreach($param as $key => $inpup){
            if($key === 'id'){
                $deporte = $this->deporteRepository->find($inpup);
            }
        }
        $matrix = [];
        foreach($param as $key => $inpup){
            if($key === 'data'){
                $data = explode('&',$inpup);
                foreach($data as $type){
                    $finded = strpos($type, 'fila');
                    if($finded !== false){
                        $file = explode('=',$type);
                        $matrix[$file[1]] = [];
                    }
                }
                $fila = null;
                for($i=0; $i <=count($data)-1; $i++){
                    $finded = strpos($data[$i], 'fila');
                    if($finded !== false){
                        $info = explode('=', $data[$i]);
                        if($info !== null){
                            $fila = $info[1];
                        }
                        
                    }else{
                        $info = explode('=', $data[$i]);
                        if($info !== ''){
                            $matrix[$fila][]=$info[1];
                        }
                    }
                }
            }
        }
        $myFile = $this->getParameter('template_directory').'/'.$deporte->getNombre().".html.twig";
         // or .php   
        $fh = fopen($myFile, 'w+'); // or die("error");  
        $stringData = '<div class="court-helper">';
        for($team = 1; $team <=2;$team++){
            foreach($matrix as $array){
                $colSize = 12/count($array);
                $lines = count($matrix);
                $heightClass = '';
                switch($lines){
                    case 1 : $heightClass = 'pos_1';break;
                    case 2 : $heightClass = 'pos_2';break;
                    case 3 : $heightClass = 'pos_3';break;
                    case 4 : $heightClass = 'pos_4';break;
                    case 5 : $heightClass = 'pos_5';break;
                }
                $stringData .= '<div class="row '.$heightClass.'">
                {% set break = false %}
                {% set vote = \'\' %}
                {% set voteBreak = false %}
                {% set user = \'\' %}';
                foreach($array as $posicion){

                    $stringPos = '<div class="col-md-'.$colSize.' col-sm-'.$colSize.' " id="'.$posicion.'-'.$team.'">
                    {% for  participante, value in global.participantes %}
                        {% if participante == \''.$posicion.$team.'\' %}
                            {% set user = value %}
                            {% set break = true %} 
                        {% endif %}
                    {% endfor %}
                    {% if break == true %}
                        <div class="prueba"><img src="/SportSpals/public/avatars/{{user}}" class="position-avatar" alt="" value="" >
                        {% for posicion, rate in global.votos %}
                            {% if posicion == user %}
                                {% set vote = rate %}
                                {% set voteBreak = true %} 
                            {% endif %}
                        {% endfor %}
                        {% if voteBreak == true %}
                            <div class="row class="position-avatar"">
                                {% if vote == 1 %}
                                    <span class="glyphicon glyphicon-star"></span>
                                {% endif %}
                                {% if vote == 2 %}
                                    <span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span>
                                {% endif %}
                                {% if vote == 3 %}
                                    <span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span>
                                {% endif %}
                                {% if vote == 4 %}
                                    <span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span>
                                {% endif %}
                                {% if vote == 5 %}
                                    <span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span>
                                {% endif %}
                            </div>   
                        {% endif %}
                        {% if app.user and app.user.avatar != user and app.user.avatar in global.participantes %}
                            <div class="vote">
                                <div class="row">
                                    Puntua al jugador
                                </div>
                                <form name="rate" id="rate_form" action="{{ path(\'valoracion_new_ajax\') }}" >
                                    <div class="rating">
                                        <span class="star" value="{{user}}_5_{{global.evento.id}}">☆</span>
                                        <span class="star" value="{{user}}_4_{{global.evento.id}}">☆</span>
                                        <span class="star" value="{{user}}_3_{{global.evento.id}}">☆</span>
                                        <span class="star" value="{{user}}_2_{{global.evento.id}}">☆</span>
                                        <span class="star" value="{{user}}_1_{{global.evento.id}}">☆</span>
                                    </div>
                                </form>
                            </div>
                        {% endif %}
                    </div>
                    {% elseif global.rolled  or app.user is null %}
                        <div class="row">
                            '.$posicion.' del equipo '.$team.'
                        </div>
                    {% else %}
                        <div class="row">
                            '.$posicion.' del equipo '.$team.'
                        </div>
                        <div class="row">
                            <button class="btn-add"> 
                                <span class="glyphicon glyphicon-plus"></span>
                            </button>
                        </div>
                    {% endif %}
                </div>';
                $stringData .=$stringPos;
                }
            $stringData .='</div>';
            }
        }
        
        $stringData .='</div>';
        fwrite($fh, $stringData);
        fclose($fh);

        die;
    }
}