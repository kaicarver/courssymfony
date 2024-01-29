<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UtilisateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nom', TextType::class, ["attr" => ["class" => "form-control"]])
        ->add('prenom', TextType::class, ["attr" => ["class" => "form-control"]])
        ->add('email', EmailType::class, ["attr" => ["class" => "form-control"]])
        ->add('password', RepeatedType::class, [
            "type" => PasswordType::class,
            "attr" => ["class" => "form-control"],
            "first_options" => [
                "label" => "Mot de passe", 
                "attr" =>["class" => "form-control" ], 
                "label_attr" => ["class" => "text-black" ]
            ],
            "second_options" => [
                "label" => "Mot de passe (verif)", 
                "attr" =>["class" => "form-control" ], 
                "label_attr" => ["class" => "text-black" ]],
            ])
        ->add('roles', ChoiceType::class, [
            "multiple" => true,
            "choices" => [
                "Administrateur" => "ROLE_ADMIN",
                "Client" => "ROLE_CLIENT",
            ],
            ])
        ->add('Sauvegarder', SubmitType::class, ["attr" => ["class" => "form-control"]]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
