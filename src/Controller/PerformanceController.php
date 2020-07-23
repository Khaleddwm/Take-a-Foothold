<?php

namespace App\Controller;

use App\Entity\Performance;
use App\Form\PerformanceType;
use App\Form\SearchPlayerType;
use App\Repository\PerformanceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/performance")
 */
class PerformanceController extends AbstractController
{
    /**
     * @Route("/", name="performance_index", methods={"POST", "GET"})
     */
    public function index(PerformanceRepository $performanceRepository, Request $request): Response
    {
        $searchPlayer = $this->createForm(SearchPlayerType::class,);
        $searchPlayer->handleRequest($request);

        if ($searchPlayer->isSubmitted() && $searchPlayer->isValid()) {
            $criteria = $searchPlayer->getData();
            return $this->redirectToRoute('search_index', ['criteria' => $criteria['name']]);
        }

        return $this->render('performance/index.html.twig', [
            'performances' => $performanceRepository->findAll(),
            'search' => $searchPlayer->createView(),
        ]);
    }

    /**
     * @Route("/new", name="performance_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $performance = new Performance();
        $form = $this->createForm(PerformanceType::class, $performance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($performance);
            $entityManager->flush();

            return $this->redirectToRoute('performance_index');
        }

        $searchPlayer = $this->createForm(SearchPlayerType::class,);
        $searchPlayer->handleRequest($request);

        if ($searchPlayer->isSubmitted() && $searchPlayer->isValid()) {
            $criteria = $searchPlayer->getData();
            return $this->redirectToRoute('search_index', ['criteria' => $criteria['name']]);
        }

        return $this->render('performance/new.html.twig', [
            'performance' => $performance,
            'form' => $form->createView(),
            'search' => $searchPlayer->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="performance_show", methods={"GET", "POST"})
     */
    public function show(Performance $performance, Request $request): Response
    {
        $searchPlayer = $this->createForm(SearchPlayerType::class,);
        $searchPlayer->handleRequest($request);

        if ($searchPlayer->isSubmitted() && $searchPlayer->isValid()) {
            $criteria = $searchPlayer->getData();
            return $this->redirectToRoute('search_index', ['criteria' => $criteria['name']]);
        }

        return $this->render('performance/show.html.twig', [
            'performance' => $performance,
            'search' => $searchPlayer->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="performance_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Performance $performance): Response
    {
        $form = $this->createForm(PerformanceType::class, $performance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('performance_index');
        }

        $searchPlayer = $this->createForm(SearchPlayerType::class,);
        $searchPlayer->handleRequest($request);

        if ($searchPlayer->isSubmitted() && $searchPlayer->isValid()) {
            $criteria = $searchPlayer->getData();
            return $this->redirectToRoute('search_index', ['criteria' => $criteria['name']]);
        }

        return $this->render('performance/edit.html.twig', [
            'performance' => $performance,
            'form' => $form->createView(),
            'search' => $searchPlayer->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="performance_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Performance $performance): Response
    {
        if ($this->isCsrfTokenValid('delete'.$performance->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($performance);
            $entityManager->flush();
        }

        return $this->redirectToRoute('performance_index');
    }
}
