<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FlowLabController extends AbstractController
{
    #[Route('/flowlab', name: 'app_flow_lab')]
    public function index(): Response
    {
        return $this->render('flow_lab/index.html.twig', [
            'controller_name' => 'FlowLabController',
        ]);
    }
}
