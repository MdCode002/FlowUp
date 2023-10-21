<?php

namespace App\Controller;

use App\Form\ChangePasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ComptePasswordController extends AbstractController
{

    
    private $entityManager;

public function __construct(EntityManagerInterface $entityManager)
{
    $this->entityManager = $entityManager;
}
    #[Route('/compte/changer-mots-de-passe', name: 'app_compte_password')]
    public function index(Request $request , UserPasswordHasherInterface $hasher): Response
    {
        $notification = null;
        $warning = null;

        $user = $this->getUser();
        $form = $this->createForm(ChangePasswordType::class, $user);
        $form->handleRequest($request);
        $old_pswd = $form->get("old_password")->getData();
        if($form->isSubmitted() && $form->isValid()){
            if($hasher->isPasswordValid($user , $old_pswd)){
                $new_password = $form->get("new_password")->getData();
                $password = $hasher->hashPassword($user,$new_password);
                $user->setPassword($password);

                $this->entityManager->persist($user);
                $this->entityManager->flush();
                $notification = "Votre Mots de passe a été modifié";
                $warning = false;

            }else{
                $notification = "Le mots de passe actuel saise est incorrecte";
                $warning = true;

            }

        }

        return $this->render('compte/password.html.twig', ["form"=>$form->createView()
       ,"notif"=>$notification , "warning"=>$warning]);
    }
}
