<?php

namespace App\Form;

use App\Entity\Hebergement;
use App\Entity\ReservationHebergement;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;


class ReservationHebergementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        
        $builder
            ->add('id')
            ->add('date_debut', DateType::class, [
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('date_fin', DateType::class, [
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('nb_perso')
            ->add('id_user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ])
            ->add('id_hebergement', EntityType::class, [
                'class' => Hebergement::class,
                'choice_label' => 'id',
            ]);
        
}
}
