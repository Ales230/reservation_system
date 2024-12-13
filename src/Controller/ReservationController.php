<?php


namespace App\Controller;

use App\Entity\Reservation;
use App\Repository\ReservationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ReservationController extends AbstractController
{
    #[Route('/reservation', name: 'create_reservation', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager, ValidatorInterface $validator, ReservationRepository $reservationRepository): Response
    {
        $reservation = new Reservation();
        $reservation->setDate(new \DateTime($request->request->get('date')));
        $reservation->setTimeSlot($request->request->get('timeSlot'));
        $reservation->setEventName($request->request->get('eventName'));

        $reservation->setUser($this->getUser());

        $errors = $validator->validate($reservation);
        if (count($errors) > 0) {
            return $this->json((string) $errors, Response::HTTP_BAD_REQUEST);
        }


        if ($reservationRepository->findBy(['date' => $reservation->getDate(), 'timeSlot' => $reservation->getTimeSlot()])) {
            throw new \Exception('Cette plage horaire est déjà réservée.');
        }

        // Sauvegarder la réservation
        $entityManager->persist($reservation);
        $entityManager->flush();

        return $this->json('Réservation créée avec succès!', Response::HTTP_CREATED);
    }
}
