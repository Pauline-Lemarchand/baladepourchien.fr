<?php

namespace App\Form;

use App\Entity\Dogs;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class DogsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nameDog',  TextType::class,[
                'label' => 'Nom du chien'
            ] ) 
            ->add('raceDog')
            ->add('descriptionDog')
            ->add('ageDog')
            ->add('photoDog', FileType::class, [
                'label' => 'Photo de votre chien',
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
            'data_class' => Dogs::class,
        ]);
    }
}
