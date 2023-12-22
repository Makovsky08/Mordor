<?php
declare(strict_types=1);

namespace App\Form;

use App\Entity\Response;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ResponseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('text', TextareaType::class, [
                'label' => 'Text námitek'
            ])
            // Typ může být předvyplněný nebo skrytý, pokud je to vždy "námitka"
            ->add('type', HiddenType::class, [
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
            'data_class' => Response::class,
        ]);
    }
}
