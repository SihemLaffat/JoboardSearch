<?php


namespace App\Services;
use App\Repository\CardRepository;
use Symfony\Component\Serializer\Encoder\CsvEncoder;

class CardService
{

    public $cardRepositery;
    public $csvEncodeur;

    public function __construct(CardRepository $cardRepositery){

        $this->cardRepositery= $cardRepositery;
        $this->csvEncodeur = new CsvEncoder();
    }
    public function csvExport($user){

        $allCard = $this->cardRepositery->findAll();
        //$allCard= $this->cardRepository->findBy(['utilisateur'=>$user]);
        $dataCsv = $this->csvEncodeur->encode($allCard, 'csv');
        return $dataCsv;
    }
}