<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DijitiController extends AbstractController
{
    /**
     * @Route("/dijiti", name="dijiti")
     */
    public function index(): Response
    {
        return $this->render('dijiti/index.html.twig', [
            'controller_name' => 'DijitiController',
        ]);
    }
}
