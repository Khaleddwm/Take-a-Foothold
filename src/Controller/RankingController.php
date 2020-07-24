<?php

namespace App\Controller;

use App\Form\SearchPlayerType;
use App\Repository\PerformanceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ranking")
 */
class RankingController extends AbstractController
{
    /**
     * @Route("/goals", name="ranking_goals", methods={"POST", "GET"})
     * 
     */
    public function goals(PerformanceRepository $performanceRepository, Request $request): Response
    {
        $searchPlayer = $this->createForm(SearchPlayerType::class,);
        $searchPlayer->handleRequest($request);

        if ($searchPlayer->isSubmitted() && $searchPlayer->isValid()) {
            $criteria = $searchPlayer->getData();
            return $this->redirectToRoute('search_index', ['criteria' => $criteria['name']]);
        }

        return $this->render('ranking/goals.html.twig', [
            'classement' => $performanceRepository->classementGoals(),
            'search' => $searchPlayer->createView(),
        ]);
    }

    /**
     * @Route("/assists", name="ranking_assists", methods={"POST", "GET"})
     * 
     */
    public function assists(PerformanceRepository $performanceRepository, Request $request): Response
    {
        $searchPlayer = $this->createForm(SearchPlayerType::class,);
        $searchPlayer->handleRequest($request);

        if ($searchPlayer->isSubmitted() && $searchPlayer->isValid()) {
            $criteria = $searchPlayer->getData();
            return $this->redirectToRoute('search_index', ['criteria' => $criteria['name']]);
        }

        return $this->render('ranking/assists.html.twig', [
            'classement' => $performanceRepository->classementAssists(),
            'search' => $searchPlayer->createView(),
        ]);
    }
}