<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * ProfilController
 * @package App\Controller
 * @Route("/compte")
 * 
 */

class UtilisateurController extends AbstractController
{
    /**
     * @Route("/utilisateur", name="utilisateur")
     * @IsGranted("ROLE_USER")
     */
    
    public function index(): Response
    {
        $user = $this->getUser();
        
        return $this->render('utilisateur/utilisateur.html.twig', [
            'utilisateur' => $user,
        ]);
    }
}
