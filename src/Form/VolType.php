<?php

namespace App\Form;

use App\Entity\Vol;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VolType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('id')
            ->add('compagnie')
            ->add('aeroportDepart')
            ->add('aeroportArrivee')
            ->add('dateDepart', null, [
                'widget' => 'single_text',
            ])
            ->add('dateArrivee', null, [
                'widget' => 'single_text',
            ])
            ->add('prix')
            ->add('destination')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vol::class,
        ]);
    }
}
