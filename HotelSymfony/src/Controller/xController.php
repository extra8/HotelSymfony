<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Entity\Room;
use App\Entity\Feedback;
use App\Entity\Reservation;
use App\Entity\MakeReservation;
use App\Form\MakeReservationType;
use App\Repository\MakeReservationRepository;
use App\Repository\ReservationRepository;
use App\Repository\RoomRepository;
use App\Repository\CustomerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class xController extends AbstractController
{
    /**
     * @Route("/", name="make_reservation_index", methods={"GET"})
     */
    // public function index(MakeReservationRepository $makeReservationRepository): Response
    // {
    //     return $this->render('make_reservation/index.html.twig', [
    //         'make_reservations' => $makeReservationRepository->findAll(),
    //     ]);
    // }

    /**
     * @Route("/makeReservationNew", name="make_new", methods={"GET","POST"})
     */
    public function new(Request $request, CustomerRepository $customerRepository, RoomRepository $roomRepository): Response
    {
        $makeReservation = new MakeReservation();
        $form = $this->createForm(MakeReservationType::class, $makeReservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) { 
            $firstName = $form->get('FirstName')->getData();
            $lastName = $form->get('LastName')->getData();
            $email = $form->get('Email')->getData();
            $startDate = $form->get('StartDate')->getData();
            $endDate = $form->get('EndDate')->getData();

            $entityManager = $this->getDoctrine()->getManager();
            
            $customers = $customerRepository -> findBy(array('Address' => $email))[0];
            $customer = null;

            if(count($customers) > 0)
            {
                $customer = $customers;
            }
            else
            {
                $customer = new Customer();
                $customer -> setUsername(""); 
                $customer -> setPassword("");  
                $customer -> setFirstName($firstName); 
                $customer -> setLastName($lastName); 
                $customer -> setAddress($email); 
                $customer -> setPhone($form->get('Phone')->getData());
                $entityManager->persist($customer);
            }
            
            $rooms = $roomRepository->findAll();
            $conflictingReservations = array();
            foreach($rooms as &$room)
            {   
                $reservations = $room -> getRoomReservationRelation();
                foreach($reservations as &$reservation)
                {
                    if( ($reservation -> getStartDate() > $startDate && $reservation -> getStartDate() < $endDate) ||
                        ($startDate > $reservation -> getStartDate() && $startDate < $reservation -> getEndDate()) ||
                        ($startDate > $reservation -> getStartDate() && $endDate < $reservation -> getEndDate()) ||
                        ($startDate < $reservation -> getStartDate() && $startDate > $reservation -> getEndDate()) )
                    {
                        $conflictingReservations[] = $reservation; 
                    }
                }
            }

            $conflictingRooms = array();
            foreach($conflictingReservations as &$conflictingReservation)
            {
                $conflictingRooms[] = $conflictingReservation -> getRoom(); 
            }                

            $goodRoom = null;
            foreach($rooms as &$room)
            {
                if (!(in_array($room, $conflictingRooms)) && $room -> getCapacity() >= $form->get('Guests')->getData())
                {
                    $goodRoom = $room;
                    break;
                }
            }

            if(is_null($goodRoom))
            {
                return $this->redirectToRoute('make_reservation_new');
            }
            else
            {
                $reservation = new Reservation();            
                $reservation -> setRoom($goodRoom);            
                $reservation -> setCustomer($customer);            
                $reservation -> setStartDate($startDate);            
                $reservation -> setEndDate($endDate);
                
                $entityManager->persist($reservation);
                $this->sendMail($firstName . " " . $lastName, $email);
                return $this->redirectToRoute('home_index');
            }            
        }

        return $this->render('make_reservation/new.html.twig', [
            'make_reservation' => $makeReservation,
            'form' => $form->createView(),
        ]);
    }

    public function sendMail($name, $email)
    {
        $transport = (new \Swift_SmtpTransport('smtp.googlemail.com', 465, 'ssl'))
        ->setUsername('cristi95andi@gmail.com')
        ->setPassword('cristian8');

        $mailer = new \Swift_Mailer($transport);

        $message = (new \Swift_Message('Rezervare Hotel Symfony'))
            ->setFrom('symfony.hotel@symfony.com')
            ->setTo('petrila.ac@gmail.com')
            ->setBody(
                $this->renderView(
                    'make_reservation/email.html.twig',
                    ['name' => $name]
                ),
                'text/html'
            );
        $mailer->send($message);
    }

    /**
     * @Route("/{id}", name="make_reservation_show", methods={"GET"})
     */
    // public function show(MakeReservation $makeReservation): Response
    // {
    //     return $this->render('make_reservation/show.html.twig', [
    //         'make_reservation' => $makeReservation,
    //     ]);
    // }

    /**
     * @Route("/{id}/edit", name="make_reservation_edit", methods={"GET","POST"})
     */
    // public function edit(Request $request, MakeReservation $makeReservation): Response
    // {
    //     $form = $this->createForm(MakeReservationType::class, $makeReservation);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $this->getDoctrine()->getManager()->flush();

    //         return $this->redirectToRoute('make_reservation_index');
    //     }

    //     return $this->render('make_reservation/edit.html.twig', [
    //         'make_reservation' => $makeReservation,
    //         'form' => $form->createView(),
    //     ]);
    // }

    /**
     * @Route("/{id}", name="make_reservation_delete", methods={"DELETE"})
     */
    // public function delete(Request $request, MakeReservation $makeReservation): Response
    // {
    //     if ($this->isCsrfTokenValid('delete'.$makeReservation->getId(), $request->request->get('_token'))) {
    //         $entityManager = $this->getDoctrine()->getManager();
    //         $entityManager->remove($makeReservation);
    //         $entityManager->flush();
    //     }

    //     return $this->redirectToRoute('make_reservation_index');
    // }
}
