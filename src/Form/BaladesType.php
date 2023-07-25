<?php

namespace App\Form;

use App\Entity\Balades;
use App\Entity\Dangers;
use App\Entity\Activites;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Time;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class BaladesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nameBalade', TextType::class,[
                'label' => 'Nommez la balade'
                ] )
        
            ->add('photoBalade', FileType::class, [
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
           
                ->add('timeBalade', TimeType::class, [
                    'input' => 'timestamp',
                'widget' => 'choice',// Utilisation de 'string' pour éviter les problèmes avec les heures
                    'widget' => 'single_text',
                    'label' => 'Durée de la promenade',
                    'attr' => [
                        'list' => 'minutes-list', // ID de la liste déroulante personnalisée
                    ],
                ])
            ->add('areaBalade',  ChoiceType::class,[
                'label' => 'Zone de votre balade',
                'choices' => [
                    'La Baule' => 'La Baule',
                    'Pornichet' => 'Pornichet',
                    'Guérande' => 'Guérande',
                    'Le Pouliguen' => 'Le Pouliguen',
                    'Saint-andré-des-eaux' => 'Saint-andré-des-eaux',
                ],
            ]) 
           
            ->add('activite', EntityType::class, [
                'class' =>  Activites::class,
                'choice_label' => 'nameActivite',
                'label' => 'Activité possible',
                'multiple' => true,
                'expanded' => true,
            ])
         


            ->add('latBalade',  NumberType::class,[
                'label' => 'latitude de zone de balade'
            ]) 
            ->add('lngBalade',  NumberType::class,[
                'label' => 'longitude de zone de balade'
            ]) 
         
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Balades::class,
        ]);
    }
}
