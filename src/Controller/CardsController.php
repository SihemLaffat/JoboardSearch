<?php

namespace App\Controller;

use App\Repository\CardRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class CardsController extends AbstractController
{
    /**
     * @Route("/cards", name="cards")
     */
    public function index(CardRepository $cardRepository): Response
    {
        $user =$this->getUser(); 
        $cards = $cardRepository->findBy(['utilisateur' => $user]);
        
        $vaPostuler =[];
        $postule =[];
        

        return $this->render('cards/index.html.twig', [
            'controller_name' => 'CardsController',
             'cardAll' => $cards
        ]);
    }

    /**
     * @Route("/all_cards", name="cards_all")
     */
    public function cardsAll(): Response
    {
        return $this->render('cards/index.html.twig', [
            'controller_name' => 'CardsController',
        ]);
    }
}