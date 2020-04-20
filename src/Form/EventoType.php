<?php

namespace App\Form;

use App\Entity\Deporte;
use App\Entity\Evento;
use DateTime;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;

class EventoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('deporte', EntityType::class, [
            'class'       => 'App\Entity\Deporte',
            'placeholder' => '',
        ])
        ->add('localidad', EntityType::class, [
            'class'       => 'App\Entity\Localidad',
            'placeholder' => '',
        ])
            ->add('title')
            ->add('descripcion')
            ->add('direccion')
            ->add('requeridos')
            
            ->add('dia',DateType::class,
            ['widget' => 'single_text',
            'empty_data' => 'dia']
            )
            ->add('inicio',TimeType::class,
            ['widget' => 'single_text',
            'empty_data' => 'inicio']
            )
            ->add('final',TimeType::class,
            ['widget' => 'single_text',
            'empty_data' => 'final']
            )  
        ;

        $formModifier = function (FormInterface $form, Deporte $sport = null) {
            $levels = null === $sport ? [] : $sport->getNiveles();
            $form->add('nivel', EntityType::class, [
                'class' => 'App\Entity\Nivel',
                'placeholder' => '',
                'choices' => $levels,
            ]);
        };

        $builder->addEventListener(
                FormEvents::PRE_SET_DATA,
                function (FormEvent $event)use ($formModifier){
                    $data = $event->getData();
    
                    $formModifier($event->getForm(),$data->getDeporte());
                }
            );
    
            $builder->get('deporte')->addEventListener(
                FormEvents::POST_SUBMIT,
                function (FormEvent $event) use ($formModifier) {
                    $sport = $event->getForm()->getData();
                    $parent = $event->getForm()->getParent();
                    // since we've added the listener to the child, we'll have to pass on
                    // the parent to the callback functions!
                    $formModifier($parent, $sport);
                }
            );

        }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Evento::class,
        ]);
    }
}
