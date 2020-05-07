<?php

namespace App\DataFixtures;

use App\Entity\Nivel;
use App\Repository\DeporteRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class NivelFixtures extends Fixture implements DependentFixtureInterface
{
    private $deporteRepository;

    public function __construct(DeporteRepository $deporteRepository)
    {
        $this->deporteRepository = $deporteRepository;
    }

    public function load(ObjectManager $manager)
    {
        $deporte = $this->deporteRepository->findOneBy(['nombre'=>'Tenis']);
        $futbol = $this->deporteRepository->findOneBy(['nombre'=>'Futbol']);
        $baloncesto = $this->deporteRepository->findOneBy(['nombre'=>'Baloncesto']);
        $padel = $this->deporteRepository->findOneBy(['nombre'=>'Padel']);
        $balonmano = $this->deporteRepository->findOneBy(['nombre'=>'Balonmano']);
        $ciclismo = $this->deporteRepository->findOneBy(['nombre'=>'Ciclismo']);

        $nivel0 = new Nivel();
        $nivel0->setNivel(1.5);
        $nivel0->setDeporte($futbol);
        $nivel0->setDescripcion('Conoce las reglas basicas del futbol');
        $manager->persist($nivel0);

        $nivelF2 = new Nivel();
        $nivelF2->setNivel(2.0);
        $nivelF2->setDeporte($futbol);
        $nivelF2->setDescripcion('Juega asiduamente a futbol');
        $manager->persist($nivelF2);

        $nivel1 = new Nivel();
        $nivel1->setNivel(1.5);
        $nivel1->setDeporte($baloncesto);
        $nivel1->setDescripcion('Conoce las reglas basicas del baloncesto.');
        $manager->persist($nivel1);

        $nivel = new Nivel();
        $nivel->setNivel(1.5);
        $nivel->setDeporte($deporte);
        $nivel->setDescripcion('Tienes una experiencia escasa y trabajas fundamentalmente para pasar la bola.');
        $manager->persist($nivel);

        $nivel2 = new Nivel();
        $nivel2->setNivel(2.0);
        $nivel2->setDeporte($deporte);
        $nivel2->setDescripcion('Careces de experiencia en pista y tus golpes tienen que desarrollarse. 
        Ya estás familiarizado con las posiciones básicas del juego tanto de sencillos como de dobles.');
        $manager->persist($nivel2);

        $nivel3 = new Nivel();
        $nivel3->setNivel(2.5);
        $nivel3->setDeporte($deporte);
        $nivel3->setDescripcion('Estás aprendiendo a leer las jugadas (saber dónde va a ir la bola), 
        aunque tu experiencia en pista es todavía limitada. 
        Puedes mantener peloteos cortos de bolas lentas con jugadores de tu mismo nivel.');
        $manager->persist($nivel3);

        $nivel4 = new Nivel();
        $nivel4->setNivel(3.0);
        $nivel4->setDeporte($deporte);
        $nivel4->setDescripcion('Ya tienes consistencia y regularidad golpeando bolas de velocidad media, 
        pero no te sientes cómodo con todos los golpes y fallas en el control de dirección, profundidad, 
        o velocidad de bola. Si juegas dobles, eliges la formación “uno arriba – uno abajo”.');
        $manager->persist($nivel4);

        $nivel5 = new Nivel();
        $nivel5->setNivel(3.5);
        $nivel5->setDeporte($deporte);
        $nivel5->setDescripcion('Has mejorado mucho la fiabilidad de tus golpes en el control direccional de bolas 
        rápidas, pero necesitas desarrollar el juego profundo y variado. Te muestras más agresivo en la red, 
        has mejorado en tu cobertura de pista y estás desarrollando el trabajo en equipo en dobles.');
        $manager->persist($nivel5);

        $nivel6 = new Nivel();
        $nivel6->setNivel(4.0);
        $nivel6->setDeporte($deporte);
        $nivel6->setDescripcion('Tienes fiabilidad en tus golpes, incluyendo el control direccional y la profundidad 
        con bolas más rápidas tanto de drive como de revés. Puedes hacer globos, smashes, golpes de aproximación 
        y voleas con bastante acierto e incluso fuerzas errores del contrario con tu saque. 
        Seguramente pierdes peloteos por tu impaciencia. Tu trabajo en equipo al jugar dobles es ahora evidente.');
        $manager->persist($nivel6);

        $nivel7 = new Nivel();
        $nivel7->setNivel(4.5);
        $nivel7->setDeporte($deporte);
        $nivel7->setDescripcion('Has desarrollado el uso de la velocidad de bola y el liftado y eres capaz de 
        manejar el ritmo de peloteo. Has descubierto el juego de pies, controlas la profundidad de los golpes, 
        e intentas variar tu plan de juego en función de tus oponentes. Puedes sacar primeros con potencia 
        y precisión y meter los segundos. Tiendes a pasarte de fuerza en los golpes difíciles. 
        Practicas juego de red agresivo en dobles.');
        $manager->persist($nivel7);

        $nivel8 = new Nivel();
        $nivel8->setNivel(5.0);
        $nivel8->setDeporte($deporte);
        $nivel8->setDescripcion('Tienes buena anticipación al golpe y frecuentemente tienes un golpe sobresaliente 
        o una habilidad especial en torno a la cual estructuras tu juego. Con regularidad haces un winner 
        o fuerzas el error ante bolas cortas y puedes meter voleas inalcanzables. 
        Consigues buenos globos, dejadas, medias-voleas, smashes y aplicas bien la produndidad 
        y los efectos en tus segundos servicios.');
        $manager->persist($nivel8);

        $nivelP = new Nivel();
        $nivelP->setNivel(1.0);
        $nivelP->setDeporte($padel);
        $nivelP->setDescripcion('Acaba de empezar a jugar al pádel.');
        $manager->persist($nivelP);

        $nivelP1 = new Nivel();
        $nivelP1->setNivel(1.5);
        $nivelP1->setDeporte($padel);
        $nivelP1->setDescripcion('Experiencia limitada. Sigue intentando mantener las pelotas en juego');
        $manager->persist($nivelP1);

        $nivelP2 = new Nivel();
        $nivelP2->setNivel(2.0);
        $nivelP2->setDeporte($padel);
        $nivelP2->setDescripcion(
            'DERECHA: Gesto (swing) incompleto, falta de control direccional, velocidad de bola lenta.
            REVES: Evita el revés, golpeo errático, problemas de empuñadura, gesto incompleto
            SERVICIO/RESTO: Gesto incompleto, habitualmente comete dobles faltas, bote de la bola inconsistente, resto con muchos problemas
            VOLEA: Evita subir a la red, evita la volea de revés, mal posicionamiento de pies
            REBOTES: No consigue devolver ningún rebote.
            ESTILO DE JUEGO: Familiar con las posiciones básicas, aunque se posiciona frecuentemente de manera incorrecta'
        );
        $manager->persist($nivelP2);

        $nivelP25 = new Nivel();
        $nivelP25->setNivel(2.5);
        $nivelP25->setDeporte($padel);
        $nivelP25->setDescripcion(
            'DERECHA: En desarrollo, velocidad de bola moderada.
            REVES: Problemas en preparación y empuñadura, a menudo prefiere el golpeo de derecha al de revés            
            SERVICIO/RESTO: Intento de realizar el gesto completo, velocidad de bola en servicio lenta, bote de bola inconsistente, devuelve servicios lentos.            
            VOLEA: Incomodo en la red especialmente en el revés, utiliza frecuentemente la cara del drive en las voleas de revés.            
            REBOTES: Se intenta posicionar para los rebotes aunque solo golpea la bola de forma ocasional            
            GOLPES ESPECIALES: Hace globos intencionados pero con poco control, empala la bola ocasionalmente en golpes altos (smash)            
            ESTILO DE JUEGO: Puede pelotear con una velocidad de bola lenta, débil cobertura de su espacio en la pista, permanece en la posición inicial del juego.'
        );
        $manager->persist($nivelP25);

        $nivelCI10 = new Nivel();
        $nivelCI10->setNivel(1.0);
        $nivelCI10->setDeporte($ciclismo);
        $nivelCI10->setDescripcion(
            'Nunca ha salido de ruta con la bici'
        );
        $manager->persist($nivelCI10);

        $nivelBM10 = new Nivel();
        $nivelBM10->setNivel(1.0);
        $nivelBM10->setDeporte($balonmano);
        $nivelBM10->setDescripcion(
            'Nunca ha jugado a Balonmano'
        );
        $manager->persist($nivelBM10);
        
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            DeporteFixtures::class
        );
    }
}
