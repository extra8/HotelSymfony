<?php

namespace App\Controller;

use App\Entity\MakeReservation;
use App\Form\MakeReservationType;
use App\Repository\ReservationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home_index", methods={"GET"})
     */
    public function index(): Response
    {
        $firstImage = "hotel-rogge-resita-1.jpg";

        $hotelImages = [
            "hotel-rogge-resita-2.jpg",
            "hol-receptie-hotel-rogge-resita-1.jpg",
            "hol-receptie-hotel-rogge-resita-3.jpg",
            "eceptie-hotel-rogge-resita.jpg",
            "sala-conferinte-hotel-rogge.jpg",
        ];

        return $this->render('home/index.html.twig', ['hotelImages' => $hotelImages, 'firstImage' => $firstImage]);
    }

    /**
     * @Route("/contact", name="contact", methods={"GET"})
     */
    public function contact(): Response
    {
        return $this->render('home/contact.html.twig');
    }

    /**
     * @Route("/admin", name="admin", methods={"GET"})
     */
    public function admin(): Response
    {
        return $this->render('home/admin.html.twig');
    }

    /**
     * @Route("/about", name="about", methods={"GET"})
     */
    public function about(): Response
    {
        $roomsFirstImage = "apartament-hotel-resita-rogge-dormitor.jpg";

        $roomsImages = [
            "apartament-hotel-resita-rogge-baie-cada.jpg",
            "camera-dubla-hotel-rogge-1.jpg",
            "camera-pat-matrimonial-living-hotel-rogge-1.jpg",
            "camera-pat-matrimonial-living-hotel-rogge-6.jpg",
            "camera-paturi-twin-hotel-rogge-2.jpg",
            "camera-paturi-twin-hotel-rogge-4.jpg"
        ];

        $barFirstImage = "restaurant-rogge-1.jpg";

        $barImages = [
            "restaurant-rogge-3.jpg",
            "bar-hotel-rogge-2.jpg",
            "bbar-hotel-rogge-3.jpg"
        ];

        $spaFirstImage = "spa-hotel-resita-rogge-4.jpg";

        $spaImages = [
            "spa-hotel-resita-rogge-3.jpg",
            "spa-hotel-resita-rogge-5.jpg",
            "spa-hotel-resita-rogge-8.jpg",
            "aparate-fitness-resita-hotel-rogge.jpg"
        ];

        return $this->render('home/about.html.twig',['roomsImages' => $roomsImages, 'roomsFirstImage' => $roomsFirstImage,
                                                     'spaImages' => $spaImages, 'spaFirstImage' => $spaFirstImage,
                                                     'barImages' => $barImages, 'barFirstImage' => $barFirstImage]);
    }
}