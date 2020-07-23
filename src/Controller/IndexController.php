<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PlayerRepository;

class IndexController extends AbstractController
{
    /**
     * Home page display
     * 
     * @Route("/",name="index")
     * @return Response A response instance
     */
    public function index(PlayerRepository $player) :Response
    {
        return $this->render('index.html.twig', [
            'players' => $player->findAll(),
        ]);
    }
}