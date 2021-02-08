<?php

namespace App\Controller;

use App\Services\CardService;
use App\Repository\CardRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CardsController extends AbstractController
{

    
    /**
     * @Route("/recapitulatif", name="cards_synthese")
     */
    public function cardsUserForSynthese(CardRepository $cardRepository): Response
    {

        $user =$this->getUser();
        $userCards = $cardRepository->findAll();
        // $userCards = $cardRepository->findBy(['utilisateur'=>$user])
        return $this->render('cards/index.html.twig', [
            'controller_name' => 'CardsController',
            'cards' =>$userCards,
           
        ]);
    }
    /**
     * @Route("/recapitulatif/user_data_downloard", name="User_synthese_download")
     */

    public function cardsUserDownload(CardService $cardService): Response
    {
        $user= $this->getUser();
        $userData = $cardService->csvExport($user);
        $response = new Response($userData);
        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="testing.csv"');

        return $response;

    }
}
