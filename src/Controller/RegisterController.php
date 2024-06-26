<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistersType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;


class RegisterController extends AbstractController
{

    private $entityManager;

public function __construct(EntityManagerInterface $entityManager)
{
    $this->entityManager = $entityManager;
}
    #[Route('/inscription', name: 'register')]

    public function index( Request $request , UserPasswordHasherInterface $hasher): Response
    {


        $user = new User();
        $form = $this->createForm( RegistersType::class,$user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $user = $form->getData(); 

            $password = $hasher->hashPassword($user, $user->getPassword());
            $user->setPassword($password);
            $this->entityManager->persist($user);
            $this->entityManager->flush();

            dd($user);
        }
      
        return $this->render('register/index.html.twig', [
            'form' =>  $form->createView(),
        ]);
    }
}
