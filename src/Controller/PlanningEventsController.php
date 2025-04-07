<?php

namespace App\Controller;

use App\Entity\PlanningEvents;
use App\Form\PlanningEventsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/planning/events')]
final class PlanningEventsController extends AbstractController
{
    #[Route(name: 'app_planning_events_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $planningEvents = $entityManager
            ->getRepository(PlanningEvents::class)
            ->findAll();

        return $this->render('planning_events/index.html.twig', [
            'planning_events' => $planningEvents,
        ]);
    }

    #[Route('/new', name: 'app_planning_events_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $planningEvent = new PlanningEvents();
        $form = $this->createForm(PlanningEventsType::class, $planningEvent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($planningEvent);
            $entityManager->flush();

            return $this->redirectToRoute('app_planning_events_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('planning_events/new.html.twig', [
            'planning_event' => $planningEvent,
            'form' => $form,
        ]);
    }

    #[Route('/{id_planning}', name: 'app_planning_events_show', methods: ['GET'])]
    public function show(PlanningEvents $planningEvent): Response
    {
        return $this->render('planning_events/show.html.twig', [
            'planning_event' => $planningEvent,
        ]);
    }

    #[Route('/{id_planning}/edit', name: 'app_planning_events_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PlanningEvents $planningEvent, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PlanningEventsType::class, $planningEvent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_planning_events_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('planning_events/edit.html.twig', [
            'planning_event' => $planningEvent,
            'form' => $form,
        ]);
    }

    #[Route('/{id_planning}', name: 'app_planning_events_delete', methods: ['POST'])]
    public function delete(Request $request, PlanningEvents $planningEvent, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$planningEvent->getId_planning(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($planningEvent);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_planning_events_index', [], Response::HTTP_SEE_OTHER);
    }
}
