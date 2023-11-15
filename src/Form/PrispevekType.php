<?php

namespace App\Form;

use App\Entity\Prispevek;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PrispevekType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Datum_vytvoreni')
            ->add('Tematika')
            ->add('Autor')
            ->add('vydanis')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Prispevek::class,
        ]);
    }
}
