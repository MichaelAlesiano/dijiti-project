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
        return $this->render('index.html.twig', [
            'controller_name' => 'DijitiController',
        ]);
    }

    public function gestione_utenti(): Response
    {
        return $this->render('gestione_utenti.html.twig', [
            'controller_name' => 'DijitiController',
        ]);
    }
}
