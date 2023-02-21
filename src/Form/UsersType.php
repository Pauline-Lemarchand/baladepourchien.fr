<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UsersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class,[
            'label' => 'E-mail'
            ] )
            // ->add('roles', ChoiceType::class, [
            //     'choices' => [
            //         'Admin' => 'ROLE_ADMIN',
            //         'Super' => 'ROLE_SUPER_ADMIN',
            //     ],
            // ])
            ->add('password', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'label' => 'Mot de passe',
                'mapped' => false,])
             
            ->add('nameUser', TextType::class, [
                'label' => 'Nom',])
           
            ->add('firstnameUser', TextType::class, [
                'label' => 'Prénom',])
           
            ->add('phoneUser', TelType::class,[
                'label' => 'Votre numéro'
                ] )
            // ->add('groupe')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
