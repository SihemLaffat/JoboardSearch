<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewCandidatureController extends AbstractController
{
    /**
     * @Route("candidature", name="new_candidature")
     */
    public function index(): Response
    {
        return $this->render('new_candidature/index.html.twig', [
            'controller_name' => 'NewCandidatureController',
        ]);
    }
}