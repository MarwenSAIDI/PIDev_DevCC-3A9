<?php

namespace App\Controller;

use App\Entity\ReservationEvent;
use App\Form\ReservationEventType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/reservation/event")
 */
class ReservationEventController extends AbstractController
{
    /**
     * @Route("/", name="reservation_event_index", methods={"GET"})
     */
    public function index(): Response
    {
        $reservationEvents = $this->getDoctrine()
            ->getRepository(ReservationEvent::class)
            ->findAll();

        return $this->render('reservation_event/index.html.twig', [
            'reservation_events' => $reservationEvents,
        ]);
    }

    /**
     * @Route("/gererreservation", name="GererReservation_event_index", methods={"GET"})
     */
    public function GererReservationBack(): Response
    {
        $reservationEvents = $this->getDoctrine()
            ->getRepository(ReservationEvent::class)
            ->findAll();

        return $this->render('reservation_event/reservationBack.html.twig', [
            'reservation_events' => $reservationEvents,
        ]);
    }


    /**
     * @Route("/new", name="reservation_event_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $reservationEvent = new ReservationEvent();
        $form = $this->createForm(ReservationEventType::class, $reservationEvent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reservationEvent);
            $entityManager->flush();

            return $this->redirectToRoute('reservation_event_index');
        }

        return $this->render('reservation_event/new.html.twig', [
            'reservation_event' => $reservationEvent,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="reservation_event_show", methods={"GET"})
     */
    public function show(ReservationEvent $reservationEvent): Response
    {
        return $this->render('reservation_event/show.html.twig', [
            'reservation_event' => $reservationEvent,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="reservation_event_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ReservationEvent $reservationEvent): Response
    {
        $form = $this->createForm(ReservationEventType::class, $reservationEvent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reservation_event_index');
        }

        return $this->render('reservation_event/edit.html.twig', [
            'reservation_event' => $reservationEvent,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="reservation_event_delete", methods={"POST"})
     */
    public function delete(Request $request, ReservationEvent $reservationEvent): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservationEvent->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($reservationEvent);
            $entityManager->flush();
        }

        return $this->redirectToRoute('reservation_event_index');
    }
}