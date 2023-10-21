<?php

namespace App\Controller;

use App\classe\cart;
use App\Entity\Order;
use App\Form\OrderType;
use App\Entity\OrderDetais;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrderController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/commande', name: 'commande')]
    public function index(cart $cart, Request $request): Response
    {

        if (!$this->getUser()->getAddresses()->getValues()) {
            return  $this->redirectToRoute("app_compte_addresse_add"); 
        }

        $form = $this->createForm(OrderType::class,null,["user"=>$this->getUser()]);
      
        return $this->render('order/index.html.twig', [
            "form" => $form->createView(),
            "carts" => $cart->getfull()
        ]);
    }
    #[Route('/recapitulatif', name: 'recapCommande')]
    public function add(cart $cart, Request $request): Response
    {
        $form = $this->createForm(OrderType::class,null,["user"=>$this->getUser()]);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
              $addresse = $form->get("adresses")->getData();
              
              $addresseFull = $addresse->getPrenom() . "  ". $addresse->getNom() . " : ". $addresse->getAddresse(). " - ".$addresse->getVille(). " - ". ($addresse->getInfosup() ? :$addresse->getInfosup());
              $date = new \DateTimeImmutable();
              $order = new Order();
              $order->setUser($this->getUser());
              $order->setCreatedAt($date);
              $order->setLivraison(2000);
              $order->setAddresse( $addresseFull );
              $order->setIsPaid( false ); 
              $this->entityManager->persist($order);

              foreach($cart->getfull() as $produit){
              $orderDetails = new OrderDetais();
              $orderDetails->setMyorder($order);
              $orderDetails->setProduit($produit["product"]->getNom());
              $orderDetails->setPrix($produit["product"]->getPrix()/100);
              $orderDetails->setTotal($produit["quantity"] * $produit["product"]->getPrix()/100);
              $orderDetails->setQuantite($produit["quantity"]);
              $this->entityManager->persist($orderDetails);
            }
            $this->entityManager->flush();


            
return $this->render('order/add.html.twig', [
            "carts" => $cart->getfull(),
            "address" => $form->get("adresses")->getData()

        ]);
        }
     return $this->redirectToRoute("app_cart")   ;
    }

}
