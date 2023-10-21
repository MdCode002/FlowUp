<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;


class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email',EmailType::class, ['label'=> "Email","disabled"=>true])
            ->add('firstname',TextType::class, ['label'=> "Nom","disabled"=>true])
            ->add('lastname', TextType::class,['label'=> "Prénom","disabled"=>true])
            ->add('old_password',PasswordType::class,["mapped"=>false,'label'=> "Mots de passe actuel"])
            ->add('new_password',RepeatedType::class,['label'=> "Mon nouveau mots de passe" ,"mapped"=>false, "type"=>PasswordType::class,"invalid_message"=>"Les mot de passe doivent correspondre","required"=>true, "first_options"=>["label"=> "Mon nouveau mots de passe"],"second_options"=>["label"=> "Confirmez votre nouveau Mots de passe"],"constraints" =>new Length(['min' => 6])])
            ->add('submit',SubmitType::class,['label'=> "Changer"])

            // ->add('tel',IntegerType::class, ["disabled"=>true])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
