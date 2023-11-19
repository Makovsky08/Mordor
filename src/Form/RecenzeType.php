<?php

namespace App\Form;

use App\Entity\Recenze;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecenzeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('datumRecenze')
            ->add('text')
            ->add('aktualnost')
            ->add('originalita')
            ->add('jazykovaStylistickaUroven')
            ->add('odbornaUroven')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recenze::class,
        ]);
    }
}
