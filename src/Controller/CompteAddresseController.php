<?php

namespace App\Controller;

use App\Entity\Address;
use App\Form\AddresseType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CompteAddresseController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    #[Route('/compte/addresse', name: 'app_compte_addresse')]
    public function index(): Response
    {
        return $this->render('compte/addresse.html.twig', [
          
        ]);
    }
    
    #[Route('/compte/ajouter-une-addresse', name: 'app_compte_addresse_add')]
    public function add(Request $request): Response
    {
        
        $adrress = new Address(); 
        $form = $this->createForm(AddresseType::class,$adrress); 
        $form->handleRequest($request);
        if ($form->isSubmitted()  && $form->isValid()){
            $addresse = $form->getData();
            $adrress->setUser($this->getUser());
            $adrress->setCity("Dakar");
            $this->entityManager->persist($addresse);
            $this->entityManager->flush();

            return $this->redirectToRoute("app_compte_addresse");

        }
        return $this->render('compte/addresse_add.html.twig', [
          "form"=>$form->createView(),
        ]);


    }

    #[Route('/compte/modifier-addresse/{id}', name: 'app_compte_addresse_modifier')]
    public function modifier(Request $request,$id): Response
    {
        
       $adrress =  $this->entityManager->getRepository(Address::class)->findOneById($id); 

       if(!$adrress || $adrress->getUser() != $this->getUser()){
            return $this->redirectToRoute("app_compte_addresse");
       }
        $form = $this->createForm(AddresseType::class,$adrress); 
        $form->handleRequest($request);
        if ($form->isSubmitted()  && $form->isValid()){
            $addresse = $form->getData();
            $this->entityManager->flush();

            return $this->redirectToRoute("app_compte_addresse");

        }
        return $this->render('compte/addresse_add.html.twig', [
          "form"=>$form->createView(),
        ]);
    }
    #[Route('/compte/supprimer-addresse/{id}', name: 'app_compte_addresse_supprimer')]
    public function supprimer($id): Response
    {
        
       $adrress =  $this->entityManager->getRepository(Address::class)->findOneById($id); 

       if(!$adrress || $adrress->getUser() != $this->getUser()){
            return $this->redirectToRoute("app_compte_addresse");
       }
       
           
            $this->entityManager->remove($adrress);
            $this->entityManager->flush();

           
        return $this->redirectToRoute("app_compte_addresse");
    }
}
