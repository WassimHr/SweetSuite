<?php

namespace App\Controller;

use DateTime;
use App\Entity\Commentaire;
use App\Form\CommentaireType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CommentaireRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommentaireController extends AbstractController
{
    #[Route('/commentaire', name: 'commentaire')]
    public function index(CommentaireRepository $repo): Response
    {
        $comment= $repo->findAll();
        return $this->render('commentaire/index.html.twig', [
            'comment' => $comment
        ]);
    }

    #[Route('/add_commentaire', name: 'commentaireAdd')]
    public function add(Request $globals, EntityManagerInterface $manager): Response
    {
        $commentaire = new Commentaire;

        $form = $this->createForm(CommentaireType::class, $commentaire);
        $form->handleRequest($globals);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $commentaire->setDateEnregistrement(new DateTime());
            $manager->persist($commentaire);
            $manager->flush();

            $this->addFlash('success', "Votre commentaire à bien été pris en compte !");
            return $this->redirectToRoute('commentaire');
        }

        return $this->render('commentaire/formCommentaire.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
