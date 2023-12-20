<?php
declare(strict_types=1);

namespace App\Form;

use App\Entity\Post;
use App\Entity\Release;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('topics')
            ->add('author')
            ->add('release', EntityType::class, [
                'class' => Release::class,
                'choice_label' => function (Release $release) {
                    return sprintf('Číslo %d - %s', $release->getNumber(), $release->getTopics());
                },
                'multiple' => true,
                'expanded' => true,
                'placeholder' => 'Vyberte tematické číslo',
            ])
            ->add('postDocFile', FileType::class, [
                'label' => 'Dokument (PDF/DOCX soubor)',

                // unmapped means that this field is not associated with any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF/DOCX file
                // every time you edit the Post details
                'required' => false,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '10240k',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf',
                            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                            'application/msword',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid PDF or DOCX document',
                    ])
                ],
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
