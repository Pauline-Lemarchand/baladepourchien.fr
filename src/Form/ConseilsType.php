<?php

namespace App\Form;

use App\Entity\Conseils;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ConseilsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titleConseil')
            ->add('textConseil',  TextareaType::class,[
                'label' => 'Description du conseil',

            ])
            ->add('photoConseil', FileType::class, [
                'label' => 'Imager le conseil',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                new File([
                'maxSize' => '5000k',
                'mimeTypes' => [
                'image/*',
                ],
                'mimeTypesMessage' => 'Image trop lourde',
                ])
                ],
                ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Conseils::class,
        ]);
    }
}
