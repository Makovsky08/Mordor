<?php

namespace App\Form;

use App\Entity\Prispevek;
use App\Entity\Vydani;
use Symfony\Bridge\Doctrine\Form\Type\EntityType; 
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
            ->add('vydanis', EntityType::class, [
                'class' => Vydani::class,
                'choice_label' => function (Vydani $vydani) {
                    return sprintf('Číslo %d - %s', $vydani->getCislo(), $vydani->getTematika());
                },
                'multiple' => true, // Pokud autor může vybrat pouze jedno vydání
                'expanded' => false, // Dropdown, ne radio buttons nebo checkboxes
                // 'query_builder' může být použit pro filtrování možností, pokud je to potřeba
                'placeholder' => 'Vyberte tematické číslo',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Prispevek::class,
        ]);
    }
}
