<?php

namespace App\Controller;

use App\classe\search;
use App\Entity\Produit;
use App\Form\SearchType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProduitController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/shop', name: 'app_produit')]
    public function index(Request $request): Response
    {
       
        $produit = $this->entityManager->getRepository(Produit::class)->findAll(); 
        $search = new search();
        $form = $this->createForm(SearchType::class,$search);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $produit = $this->entityManager->getRepository(Produit::class)->findWithSearch($search);
        }

       
        return $this->render('produit/index.html.twig', [
            "produits" => $produit , "form"=>$form->createView()
        ]);
    }

    #[Route('/produit/{slug}', name: 'ProduitDetails')]
    public function Show($slug): Response
    {

        $produit = $this->entityManager->getRepository(Produit::class)->findOneBySlug($slug);
        if(!$produit){
            return $this->redirectToRoute("app_produit"); 
        }
       
        return $this->render('produit/show.html.twig', [
            "produit" => $produit 
        ]);
    }
}
