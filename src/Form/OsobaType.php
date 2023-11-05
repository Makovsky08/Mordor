<?php

namespace App\Form;

use App\Entity\Osoba;
use App\Entity\Role;
use App\Form\DataTransformer\StringToRoleTransformer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OsobaType extends AbstractType
{

    private $entityManager;
    private $transformer;

    public function __construct(EntityManagerInterface $entityManager, StringToRoleTransformer $transformer)
    {
        $this->entityManager = $entityManager;
        $this->transformer = $transformer;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('jmeno')
            ->add('prijmeni')
            ->add('datum_narozeni', DateType::class, [
                'label' => 'Datum Narozeni',
                'widget' => 'single_text',
                'input' => 'datetime',
                'format' => 'yyyy-MM-dd',
            ])
            ->add('email')
            ->add('heslo')
            ->add('roles', EntityType::class, [
                'class' => Role::class, // Specify the entity class your roles are
                'choice_label' => function (Role $role) {
                    return (string) $role; // This assumes you have a method to return the role as a string
                },
                'multiple' => true,
                'expanded' => true, // Set to true if you want checkboxes instead of a select dropdown
            ])
        ;

        // // Add the transformer to the 'roles' field
        // $builder->get('roles')->addModelTransformer($this->transformer);;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Osoba::class,
        ]);
    }
}
