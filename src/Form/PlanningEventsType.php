<?php

namespace App\Form;

use App\Entity\Event;
use App\Entity\Planning;
use App\Entity\PlanningEvents;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlanningEventsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('id_planning', EntityType::class, [
                'class' => Planning::class,
                'choice_label' => 'id',
            ])
            ->add('id_event', EntityType::class, [
                'class' => Event::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PlanningEvents::class,
        ]);
    }
}
