<?php

namespace App\Controller;

use App\Service\CardService;
use App\Repository\CardRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SyntheseCardsController extends AbstractController
{

    
    /**
     * @Route("/synthese", name="cards_synthese")
     */
    public function cardsUserForSynthese(CardRepository $cardRepository): Response
    {

        $user =$this->getUser(); 
        $userCards = $cardRepository->findBy(['utilisateur' => $user]);
        
        return $this->render('Synthesecards/index.html.twig', [
            'controller_name' => 'CardsController',
            'usercards' =>$userCards,
           
        ]);
    }
    /**
     * @Route("/synthese/user_data_download", name="User_synthese_download")
     */

    public function cardsUserDownload(CardService $cardService): Response
    {
        $user= $this->getUser();
        $userData = $cardService->csvExport($user);
        $response = new Response($userData);
        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="joboardserch.csv"');

        return $response;

   }
}