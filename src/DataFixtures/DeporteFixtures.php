<?php

namespace App\DataFixtures;

use App\Entity\Deporte;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class DeporteFixtures extends Fixture
{
    public function __construct()
    {
    }

    public function load(ObjectManager $manager)
    {
        $deporte = new Deporte();
        $deporte->setNombre('Baloncesto');
        $deporte->setDescripcion('Deporte de equipo, jugado entre dos conjuntos de cinco jugadores cada uno durante
         cuatro períodos o cuartos de diez2​ o doce minutos cada uno. El objetivo del equipo es anotar puntos 
         introduciendo un balón por la canasta, un aro a 3,05 metros sobre la superficie de la pista de juego del 
         que cuelga una red. La puntuación por cada canasta o cesta es de dos o tres puntos, dependiendo de la posición 
         desde la que se efectúa el tiro a canasta, o de uno, si se trata de un tiro libre por una falta de un jugador 
         contrario. El equipo ganador es el que obtiene el mayor número de puntos');
        $deporte->setCampoJuego('Baloncesto.png');
        $manager->persist($deporte);

        $deporte2 = new Deporte();
        $deporte2->setNombre('Futbol');
        $deporte2->setDescripcion('Deporte de equipo jugado entre dos conjuntos de once jugadores cada uno y algunos 
        árbitros que se ocupan de que las normas se cumplan correctamente. Es ampliamente considerado el deporte más
         popular del mundo, pues lo practican unas 270 millones de personas');
         $deporte2->setCampoJuego('Futbol.png');
        $manager->persist($deporte2);

        $deporte3 = new Deporte();
        $deporte3->setNombre('Tenis');
        $deporte3->setDescripcion('Deporte de raqueta practicado sobre una pista rectangular (compuesta por distintas 
        superficies las cuales pueden ser cemento, tierra, o césped), delimitada por líneas y dividida por una red. 
        ​Se disputa entre dos jugadores (individuales) o entre dos parejas (dobles). El objetivo del juego es lanzar 
        una pelota golpeándola con la raqueta de modo que rebote en la otra cancha pasando la red dentro de los límites
         permitidos del campo del rival, procurando que este no pueda devolverla para conseguir un segundo rebote en el
         suelo y por ende un punto.');
         $deporte3->setCampoJuego('Tenis.png');
        $manager->persist($deporte3);

        $padel = new Deporte();
        $padel->setNombre('Padel');
        $padel->setDescripcion('Deporte de palas de origen mexicano. Se juega en parejas y consta de tres elementos 
        fundamentales para su desarrollo: la pelota, la pala y el campo de juego o pista. Consiste en hacer botar 
        la bola en el campo contrario antes de impactar con las paredes y/o verja (excepto en el servicio). 
        El jugador o jugadores opuestos deben devolver la bola con un golpe, cumpliendo con un máximo de un bote para golpearla.');
        $padel->setCampoJuego('Padel.png');
        $manager->persist($padel);

        $balonmano = new Deporte();
        $balonmano->setNombre('Balonmano');
        $balonmano->setDescripcion(' deporte de pelota en el que se enfrentan dos equipos, se caracteriza por transportarla con las manos.
         Cada equipo se compone de siete jugadores (seis de campo y un portero), pudiendo el equipo contar con otros siete jugadores 
         (o menos, o ninguno) reservas que pueden intercambiarse en cualquier momento con sus compañeros.');
        $manager->persist($balonmano);
        
        $ciclismo = new Deporte();
        $ciclismo->setNombre('Ciclismo');
        $ciclismo->setDescripcion(' deporte en el que se utiliza una bicicleta1​ para recorrer Circuitos al Aire Libre o en Pista Cubierta 
        y que engloba diferentes especialidades.');
        $manager->persist($ciclismo);
        
        $manager->flush();
    }
}
