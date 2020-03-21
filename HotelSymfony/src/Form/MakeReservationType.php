<?php

namespace App\Form;

use App\Entity\MakeReservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MakeReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('FirstName')
            ->add('LastName')
            ->add('Phone')
            ->add('Email')
            ->add('StartDate')
            ->add('EndDate')
            ->add('Guests')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MakeReservation::class,
        ]);
    }
}
