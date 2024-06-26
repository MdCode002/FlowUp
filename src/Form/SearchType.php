<?php

namespace App\Form;

use App\classe\search;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class SearchType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('string', TextType::class,['label'=> false,"required"=>false ,"attr"=>[
                "class"=>"form-control-sm" ]])
            ->add('categories', EntityType::class,
            ['label'=> false,
            "required"=>false,
            "class"=>Category::class ,
            "multiple"=>true,
            "expanded"=>true])
            ->add('submit', SubmitType::class,['label'=> "Filtrer",
            "attr"=>[
            "class"=>"btn-block btn-warning" ]]);

            

    }



    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => search::class,
            'method' => 'GET',
            'csrf_protection' => false,
        ]);
    }
    public function getBlockPrefix(){
        return "";
    }
}