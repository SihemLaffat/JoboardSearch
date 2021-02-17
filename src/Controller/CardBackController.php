<?php

namespace App\Controller;

use App\Entity\Card;
use App\Form\CardType;
use App\Service\CardService;
use App\Repository\CardRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * @Route("/card")
 * @IsGranted("ROLE_USER")
 */
class CardBackController extends AbstractController
{
    /**
     * @Route("/", name="card_index", methods={"GET"})
     */
    public function index(CardRepository $cardRepository): Response
    {
        return $this->render('card/index.html.twig', [
            'cards' => $cardRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new/{status}", name="card_new", methods={"GET","POST"})
     */
    public function new(Request $request, int $status, CardService $cardService): Response
    {
        $status_card = $cardService->getStatusCard($status);
        
        if ($status_card === null){
            throw new BadRequestException();
        }

        
        $card = new Card();
        $form = $this->createForm(CardType::class, $card,['defaultStatus'=> $status_card]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $card->setCreatedAt(new \DateTime('now'));
            $user = $this->getUser();
            $card->setUtilisateur($user);
            $entityManager->persist($card);
            $entityManager->flush();

            return $this->redirectToRoute('cards');
        }

        return $this->render('card/new.html.twig', [
            'card' => $card,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="card_show", methods={"GET"})
     */
    public function show(Card $card): Response
    {
        return $this->render('card/show.html.twig', [
            'card' => $card,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="card_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Card $card): Response
    {
        $form = $this->createForm(CardType::class, $card,['defaultStatus'=> $card->getStatusCard()]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cards');
        }

        return $this->render('card/edit.html.twig', [
            'card' => $card,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="card_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Card $card): Response
    {
        if ($this->isCsrfTokenValid('delete'.$card->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($card);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cards');
    }
    

    /**
     * @Route("/{id}/status", name="card_update-status", methods={"PUT"})
     *
     * @param Card $card
     * @param integer $statusNumber
     * @return void
     */
    public function updateStatusCard(Request $request, Card $card, CardService $cardService, CardRepository $cardRepository){
        
        if($card->getUtilisateur()->getId() !== $this->getUser()->getId()){
            throw new AccessDeniedException("Vous n'êtes pas autorisée à modifier cette carte");
        }
        
        $statusNumber = $request->request->get('statusNumber');
        $statusCard = $cardService->getStatusCard($statusNumber);
        
        $card->setStatusCard($statusCard);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($card);
        $entityManager->flush();
        
        return new Response('Card correctly updated');
    }
}