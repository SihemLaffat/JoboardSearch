<?php

namespace App\Service;

use App\Repository\CardRepository;
use Symfony\Component\Serializer\Encoder\CsvEncoder;

class CardService {
    
    public static $STATUS_1 = 'va postuler'; 
    public static $STATUS_2 = 'postule'; 
    public static $STATUS_3 = 'relancer'; 
    public static $STATUS_4 = 'rencontre'; 

    public $cardRepositery;
    public $csvEncodeur;

    
    public function getStatusCard(int $statusNumber){
        
        switch($statusNumber){
            case 1:
                return CardService::$STATUS_1;
            case 2:
                return CardService::$STATUS_2;
            case 3:
                return CardService::$STATUS_3;
            case 4:
                return CardService::$STATUS_4;
            default:
                return null;
        }
    
    }

    
   public function __construct(CardRepository $cardRepositery){

       $this->cardRepositery= $cardRepositery;
       $this->csvEncodeur = new CsvEncoder();
    }
   public function csvExport($user){

        // $allCard = $this->cardRepositery->findAll();
        $allCard= $this->cardRepository->findBy(['utilisateur'=>$user]);
       $dataCsv = $this->csvEncodeur->encode($allCard, 'csv');
       return $dataCsv;
   }
}