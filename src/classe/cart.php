<?php
namespace App\classe;
use App\Entity\Produit;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class cart
{
    private $requestStack;
    private $entityManager;

    public function __construct( EntityManagerInterface $entityManager,RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
        $this->entityManager = $entityManager;
    }
    public function add($id)
    {
        $session = $this->requestStack->getSession();
        $cart = $session->get("cart",[]);
        if(!empty($cart[$id])){
            $cart[$id]++;
        }else{
            $cart[$id] = 1;
        }
        $session->set("cart",$cart);
    }
  
    public function moin($id)
    {
        $session = $this->requestStack->getSession();
        $cart = $session->get("cart",[]);
        if(!empty($cart[$id])){
        if($cart[$id] > 1){
            $cart[$id]-- ;
        }
        }
        $session->set("cart",$cart);
    }

    public function Produitremove($id)
    {
        $session = $this->requestStack->getSession();
        $cart = $session->get("cart",[]);
        if(!empty($cart[$id])){
            unset($cart[$id]);
        }
        $session->set("cart",$cart);
    }
    public function get(){
        $session = $this->requestStack->getSession();
       return $session->get("cart");
        
    }
    public function remove(){
        $session = $this->requestStack->getSession();
       return $session->remove("cart");
        
    }

    public function getfull(){
        $cartComplete = [];
        if($this->get() ){
        foreach ($this->get() as $id => $qt) {

            $productObjet = $this->entityManager->getRepository(Produit::class)->findOneById($id);
            if(!$productObjet){
                $this->Produitremove($id);
                continue;

            }
            $cartComplete[] = [
                'product' => $productObjet,
                'quantity' => $qt
            ];
        }}
        return $cartComplete;
    }
} 