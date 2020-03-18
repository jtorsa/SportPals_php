<?php

namespace App\DataFixtures;

use App\Entity\Localidad;
use App\Entity\Provincia;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class Provinciafixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $provincia = new Provincia();
        $provincia->setNombre('Valencia');

        $localidad = new Localidad();
        $localidad->setNombre('Valencia');
        $localidad->setProvincia($provincia);

        $localidad2 = new Localidad();
        $localidad2->setNombre('Godella');
        $localidad2->setProvincia($provincia);

        $localidad3 = new Localidad();
        $localidad3->setNombre('Torrente');
        $localidad3->setProvincia($provincia);

        $localidad4 = new Localidad();
        $localidad4->setNombre('Cullera');
        $localidad4->setProvincia($provincia);
/******************************************** */
        $provincia2 = new Provincia();
        $provincia2->setNombre('Madrid');
        
        $localidad5 = new Localidad();
        $localidad5->setNombre('Madrid');
        $localidad5->setProvincia($provincia2);

        $localidad6 = new Localidad();
        $localidad6->setNombre('Tres Cantos');
        $localidad6->setProvincia($provincia2);

        $localidad7 = new Localidad();
        $localidad7->setNombre('Alcobendas');
        $localidad7->setProvincia($provincia2);

        $localidad8 = new Localidad();
        $localidad8->setNombre('Coslada');
        $localidad8->setProvincia($provincia2);



        $manager->persist($provincia);
        $manager->persist($provincia2);
        $manager->persist($localidad);
        $manager->persist($localidad2);
        $manager->persist($localidad3);
        $manager->persist($localidad4);
        $manager->persist($localidad5);
        $manager->persist($localidad6);
        $manager->persist($localidad7);
        $manager->persist($localidad8);

        $manager->flush();
    }
}
