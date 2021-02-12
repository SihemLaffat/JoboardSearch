<?php

namespace App\Controller;

use App\Service\CardService;
use App\Repository\CardRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @IsGranted("ROLE_USER")
 */
class CardFrontController extends AbstractController
{
    /**
     * @Route("/cards", name="cards")
     */
    public function index(CardRepository $cardRepository): Response
    {
        
        $user =$this->getUser(); 
        $cards = $cardRepository->findBy(['utilisateur' => $user]);
        
        $vaPostuler =[];
        $postuler =[];
        $relancer =[];
        $entretien =[];

        foreach($cards as $card){

            $result = [
                'status_card' =>$card->getStatusCard(),
                'id'=> $card->getId(),
                'titre'=>$card->getTitre(),
                'description'=> $card->getDescription(),
                'ville'=> $card->getVille(),
                'telephone'=> $card->getTelephone(),
                'email'=> $card->getEmail(),
                'CreatedAd'=> $card->getCreatedAt()->format('Y-m-d H:i:s'),     
            ];
         if( $card->getStatusCard() == CardService::$VA_POSTULER )  {
            $vaPostuler []= $result;

        }
          
        if( $card->getStatusCard() == CardService::$POSTULE )  {
            $postuler []= $result;

        }
        if( $card->getStatusCard() == CardService::$RELANCER )  {
            $relancer []= $result;

        }  
        if( $card->getStatusCard() == CardService::$RENCONTRE )  {
            $entretien []= $result;

        }
        }

        return $this->render('cards/index.html.twig', [
            'controller_name' => 'CardsController',
             'vapostuler' => $vaPostuler,
             'postuler' => $postuler,
             'relancer' => $relancer,
             'entretien' => $entretien,
        ]);
    }
}