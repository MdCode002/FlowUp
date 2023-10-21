<?php

namespace App\Controller;

use App\classe\Paytech;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PaiementController extends AbstractController
{
    #[Route('/paiement', name: 'app_paiement')]
    public function index(Paytech $paiement): Response
    {
        
        return $this->render('paiement/index.html.twig', [
           
        ]);
    }
}
