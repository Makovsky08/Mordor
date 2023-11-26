<?php
declare(strict_types=1);

namespace App\Form;

use App\Entity\User;
use App\Entity\Role;
use App\Form\DataTransformer\StringToRoleTransformer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
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
            ->add('name')
            ->add('surname')
            ->add('birthdate', DateType::class, [
                'label' => 'Datum narozeni',
                'widget' => 'single_text',
                'input' => 'datetime',
                'format' => 'yyyy-MM-dd',
            ])
            ->add('email')
            ->add('password')
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
            'data_class' => User::class,
        ]);
    }
}
