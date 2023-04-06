<?php

namespace App\Form;

use App\Entity\Balades;
use App\Entity\Dangers;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class DangersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            
            ->add('areaDanger', TextType::class,[
                'label' => 'Zone du danger'
                ] )
                ->add('nameDanger', TextType::class,[
                    'label' => 'Type de danger'
                    ] )
                ->add('balade', EntityType::class, [
                        'class' => Balades::class,
                        'choice_label' => 'nameBalade',
                        'label' => 'Balades',
                        'multiple' => true,
                        'expanded' => true,
                    ])
                    ->add('lat_danger',  NumberType::class,[
                        'label' => 'latitude de zone de balade'
                    ]) 
                    ->add('lng_danger',  NumberType::class,[
                        'label' => 'longitude de zone de balade'
                    ]) 
                    
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Dangers::class,
        ]);
    }
}
