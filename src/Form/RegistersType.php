<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Validator\Constraints\Length;

class RegistersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class,['label'=> "Prénom","constraints" => new Length(['min' => 2, 'max' => 30])],
                
            )
            ->add('lastname', TextType::class,['label'=> "Nom","constraints" => new Length(['min' => 2, 'max' => 30])])
            ->add('email', EmailType::class,['label'=> "Email","constraints" => new Length(['min' => 2, 'max' => 30])])
            ->add('tel',IntegerType ::class,['label'=> "Telephone","constraints" => new Length(['min' => 5, 'max' => 15])])
            ->add('password',RepeatedType::class,['label'=> "Mots de passe" , "type"=>PasswordType::class,"invalid_message"=>"Les mot de passe doivent correspondre","required"=>true, "first_options"=>["label"=> "mots de passe"],"second_options"=>["label"=> "Confirmez votre Mots de passe"],"constraints" =>new Length(['min' => 6])])
            ->add('submit',SubmitType::class,['label'=> "S'inscrire"])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
