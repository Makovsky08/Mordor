<?php
declare(strict_types=1);

namespace App\Form;

use App\Entity\Post;
use App\Entity\Release;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('created_at')
            ->add('topics')
            ->add('author')
            ->add('release', EntityType::class, [
                'class' => Release::class,
                'choice_label' => function (Release $release) {
                    return sprintf('Číslo %d - %s', $release->getNumber(), $release->getTopics());
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
            'data_class' => Post::class,
        ]);
    }
}
