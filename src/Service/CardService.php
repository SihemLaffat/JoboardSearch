<?php

namespace App\Service;

class CardService {
    
    public static $STATUS_1 = 'status 1'; 
    public static $STATUS_2 = 'status 2'; 
    public static $STATUS_3 = 'status 3'; 
    public static $STATUS_4 = 'status 4'; 

    
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
}