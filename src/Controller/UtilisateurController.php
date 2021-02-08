<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
* Require ROLE_USER for *every* controller method in this class.
*
* @IsGranted("ROLE_USER")
*/

class UtilisateurController extends AbstractController
{
    /**
     * @Route("/utilisateur", name="utilisateur")
     */
    
    public function index(): Response
    {
        return $this->render('utilisateur/utilisateur.html.twig', [
            'controller_name' => 'UtilisateurController',
        ]);
    }
}
