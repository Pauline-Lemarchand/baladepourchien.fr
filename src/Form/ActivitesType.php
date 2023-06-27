<?php

namespace App\Form;

use App\Entity\Balades;
use App\Entity\Activites;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ActivitesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nameActivite')
            ->add('balade', EntityType::class, [
                'class' => Balades::class,
                'choice_label' => 'nameBalade',
                'label' => 'Balades',
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('emoji', FileType::class, [
                'label' => 'Photo de la balade',
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
                ])
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Activites::class,
        ]);
    }
}
