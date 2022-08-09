<?php

namespace App\Form;

use App\Entity\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('email') 
        ;
        if($options['password'])
        {
            $builder
            ->add('password', TextType::class, [
                'mapped' => false,
                'required' => false,
            ])
            ;
        }
        if($options['role'])
        {
        $builder
        ->add('roles', ChoiceType::class, [
            "required" => false,
            "choices" => [
                // key => value
                // key ==> navigateur
                // value ==> enregistrer dans la propriété
                "User" => "ROLE_USER",
                "Admin" => "ROLE_ADMIN"

            ],
            "multiple" => true,
            "expanded" => true
        ])
        ;
        }

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'password' => true,
            'role' => false,

        ]);
    }
}
