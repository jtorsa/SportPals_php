<?php

namespace App\Form;

use App\Entity\Deporte;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class DeporteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Nombre')
            ->add('Descripcion')
            ->add('requeridos')
            ->add('Campo', FileType::class,[
                'label' => 'Campo de juego',
                'mapped' => false
            ])->add('Imagen', FileType::class,[
                'label' => 'Imagen',
                'mapped' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Deporte::class,
        ]);
    }
}
