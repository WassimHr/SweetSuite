<?php

namespace App\Controller;

use App\Repository\SliderRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AppController extends AbstractController
{
    #[Route('/', name: 'app')]
    public function index(SliderRepository $repo): Response
    {    
        // $sliders = $repo->findAll();
        $sliders = $repo->findBy([], ['ordre' => 'ASC']);
        return $this->render('app/index.html.twig', [
            'sliders' => $sliders
        ]);
    }
}
