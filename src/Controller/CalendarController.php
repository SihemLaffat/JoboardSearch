<?php

namespace App\Controller;

use App\Repository\CardRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CalendarController extends AbstractController
{
    /**
     * @Route("/calendar", name="calendar_user")
     */
    public function index(CardRepository $cardRepository): Response
    {
        $events = $cardRepository->findAll();
        //findBy(['utilisateur'=>$user]);
        $candidature = [];
        
        foreach($events as $event){
            $candidature[] = [
                'id'=> $event->getId(),
                'start'=> $event->getCreatedAt()->format('Y-m-d H:i:s'),
                'title'=> $event->getTitre(),
                'description'=> $event->getStatusCard(),
                'url'=> $event->getUrl(),   
            ];
            
        }

        $data = json_encode($candidature);

        return $this->render('calendar/index.html.twig',compact('data'));
    }
}
