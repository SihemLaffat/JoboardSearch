<?php

namespace App\Service;

use App\Repository\CardRepository;
use Symfony\Component\Serializer\Encoder\CsvEncoder;

class CardService {
    
    public static $VA_POSTULER = 'va postuler'; 
    public static $POSTULE = 'postuler'; 
    public static $RELANCER = 'relancer'; 
    public static $RENCONTRE = 'rencontre'; 

    public $cardRepositery;
    public $csvEncodeur;

    
    public function getStatusCard(int $statusNumber){
        
        switch($statusNumber){
            case 1:
                return CardService::$VA_POSTULER;
            case 2:
                return CardService::$POSTULE;
            case 3:
                return CardService::$RELANCER;
            case 4:
                return CardService::$RENCONTRE;
            default:
                return null;
        }
    
    }

    
   public function __construct(CardRepository $cardRepository){

       $this->cardRepository= $cardRepository;
       $this->csvEncodeur = new CsvEncoder();
    }
   public function csvExport($user){

       $allCard = $this->cardRepository->findAllCsv($user);
       
       //$allCard= $this->cardRepository->findBy(['utilisateur'=>$user]);
       $dataCsv = $this->csvEncodeur->encode($allCard, 'csv', [CsvEncoder::DELIMITER_KEY => ';']);
       return $dataCsv;
   }
}