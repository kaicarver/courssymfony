<?php

namespace App\Form;

use App\Entity\Categorie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategorieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // <label>Non cat</label><input name="nomCat" type="text">
        $builder
            ->add('nomcat', TextType::class, [
                "attr"=>["class"=>"form-control","id"=>"nomcat"], 
                "label"=>"Nom Catég",
                "label_attr"=>["class"=>"mt-2 text-white"],
                ])
            ->add('description', TextareaType::class, [
                "attr"=>["class"=>"form-control","id"=>"description"],
                "label"=>"Desc",
                "label_attr"=>["class"=>"mt-2 text-white"],
                ])
            ->add('save', SubmitType::class, [
                "attr"=>["class"=>"btn btn-primary mt-2 mb-3","id"=>"save"],
                "label"=>"Ajouter",
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Categorie::class,
        ]);
    }
}
