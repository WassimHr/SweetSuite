<?php

namespace App\Controller;

use App\Entity\Chambre;
use App\Repository\ChambreRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ChambreController extends AbstractController
{
    #[Route('/chambre', name: 'chambre')]
    public function index(ChambreRepository $repo): Response
    {
        $chambres = $repo->findAll();
        return $this->render('chambre/index.html.twig', [
            'chambres' => $chambres
        ]);
    }

    #[Route('/show/{id}', name: 'show')]
    public function show(Chambre $chambre=null): Response
    {
        if($chambre == null)
        {
            return $this->redirectToRoute('app');
        }
        return $this->render('chambre/show.html.twig', [
            'chambre' => $chambre
        ]);
    }
}
