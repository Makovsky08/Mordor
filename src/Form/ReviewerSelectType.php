<?php

namespace App\Form;

use App\Entity\ResponseRequest;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReviewerSelectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('reviewer_id', ChoiceType::class, [
                'choices' => [
                    'Reviewer 1' => 1,
                    'Reviewer 2' => 2,
                    'Reviewer 3' => 3,
                ],
                'label' => 'Select Reviewer',
                'required' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ResponseRequest::class,
        ]);
    }
}
