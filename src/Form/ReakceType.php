<?php

namespace App\Form;

use App\Entity\Reakce;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReakceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Text', TextareaType::class, [
                'label' => 'Text námitek'
            ])
            // Typ může být předvyplněný nebo skrytý, pokud je to vždy "námitka"
            ->add('Typ', HiddenType::class, [
                'data' => 'Námitka', // Předvyplněná hodnota, pokud je vždy stejná
            ])
            // Tlačítko pro odeslání formuláře
            ->add('submit', SubmitType::class, [
                'label' => 'Odeslat námitky'
            ]);
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reakce::class,
        ]);
    }
}
