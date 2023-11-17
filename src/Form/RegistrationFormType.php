<?php

// src/Form/RegistrationFormType.php

namespace App\Form;

use App\Entity\Osoba;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('jmeno', TextType::class, [
                // customize the options as needed
                'label' => 'Name'
            ])
            ->add('prijmeni', TextType::class, [
                'label' => 'Surname'
            ])
            ->add('datum_narozeni', DateType::class, [
                'label' => 'Datum Narozeni',
                'widget' => 'single_text',
                'input' => 'datetime',
                'format' => 'yyyy-MM-dd',
            ])
            ->add('email', EmailType::class)
            ->add('heslo', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Hesla se musí rovnat.',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options'  => ['label' => 'Heslo'],
                'second_options' => ['label' => 'Potvrzeni hesla'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Osoba::class,
        ]);
    }
}