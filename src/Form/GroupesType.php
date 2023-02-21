<?php

namespace App\Form;

use App\Entity\Groupes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class GroupesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nameGroupe',  TextType::class,[
                'label' => 'Nom du groupe'
            ] )
            ->add('areaGroupe',  TextType::class,[
                'label' => 'Lieux de balade'
            ] )
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Groupes::class,
        ]);
    }
}
