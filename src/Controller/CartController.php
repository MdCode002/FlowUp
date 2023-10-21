<?php

namespace App\Controller;

use App\classe\cart;
use App\Entity\Produit;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{


    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    } 

    
    #[Route('/mon-panier', name: 'app_cart')]
    public function index(cart $cart): Response
    {
       
        
        return $this->render('cart/index.html.twig', [
            'carts' => $cart->getfull(),
        ]);
    }


    #[Route('/cart/add/{id}', name: 'cartadd')]
    public function add($id,cart $cart): Response
    {
        $cart->add($id);
        return $this->redirectToRoute('app_cart',);
    }

    #[Route('/cart/moin/{id}', name: 'cartmoin')]
    public function moin($id,cart $cart): Response
    {
        $cart->moin($id);
        return $this->redirectToRoute('app_cart',);
    }

    
    #[Route('/cart/Produitremove/{id}', name: 'Produitremove')]
    public function Produitremove($id,cart $cart): Response
    {
        $cart->Produitremove($id);
        return $this->redirectToRoute('app_cart',);
    }


    #[Route('/cart/remove', name: 'cartremove')]
    public function remove(cart $cart): Response
    {
        $cart->remove();
        return $this->redirectToRoute('app_produit',);
    }
   
}
