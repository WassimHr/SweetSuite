<?php

namespace App\Controller;

use DateTime;
use App\Entity\Chambre;
use App\Entity\Commande;
use App\Form\CommandeType;
use App\Repository\CommandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommandeController extends AbstractController
{
    #[Route('/commande', name: 'commande')]
    public function index(): Response
    {


        return $this->render('commande/index.html.twig');
    }

    #[Route('/commande_form/{id}', name: 'formCommande')]
    public function form(Request $globals, EntityManagerInterface $manager, Chambre $id_chambre): Response

    {
        $commande = new Commande;
        $commande->setIdChambre($id_chambre);

        $form = $this->createForm(CommandeType::class, $commande);
        $form->handleRequest($globals);

        if ($form->isSubmitted() && $form->isValid()) {
            $commande->setDateEnregistrement(new DateTime());
            $prixUnitaire = $commande->getIdChambre()->getPrixJournalier();

            $dateHeureDepart = $commande->getDateDepart();
            $dateHeureFin = $commande->getDateArrivee();

            // Calculer la durée en jours
            $diff = $dateHeureFin->diff($dateHeureDepart);
            $nombreJours = $diff->days;

            // Calculer le prix total
            $prixTotal = $prixUnitaire * $nombreJours;
            $commande->setPrixTotal($prixTotal);

            $manager->persist($commande);
            $manager->flush();

            $this->addFlash('success', "Votre reservation à bien été pris en compte !");
            return $this->redirectToRoute('app');
        }

        return $this->render('commande/formCommande.html.twig', [
            'form' => $form->createView(),
            'chambre' => $id_chambre
        ]);
    }
}
