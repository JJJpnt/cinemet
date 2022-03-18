<?php

namespace App\Controller;

use App\Repository\GenreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{
    /**
     * @Route("/", name="app_front")
     */
    public function index(GenreRepository $gr): Response
    {
        return $this->render('front/index.html.twig', [
            'controller_name' => 'FrontController',
            'genres' => $gr->findAll(),
        ]);
    }

    /**
     * @Route("/sliders", name="sliders")
     */
    public function sliders(GenreRepository $gr): Response
    {
        return $this->render('front/slider.html.twig', [
            'controller_name' => 'FrontController',
            'genres' => $gr->findAll(),
        ]);
    }
}
