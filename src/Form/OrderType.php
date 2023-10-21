<?php

namespace App\Form;

use App\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class OrderType extends AbstractType
{
   
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $user = $options['user'];
        $builder
        ->add('adresses', EntityType::class,
        ['label'=> "Choisissez votre addresse",
        "required"=>true,
        "class"=>Address::class ,
        "choices"=>$user->getAddresses(),
        "multiple"=>false,
        "expanded"=>true])
        ->add('submit', SubmitType::class,['label'=> "Valider ma commande",
        "attr"=>[
        "class"=>"btn-block btn-warning" ]]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
           "user" => []
        ]);
    }
}
