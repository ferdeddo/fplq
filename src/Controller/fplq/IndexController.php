<?php
/**
 * Created by PhpStorm.
 * User: Ferdeddo
 * Date: 27/12/2018
 * Time: 11:53
 */

namespace App\Controller\fplq;


use App\Entity\Restaurant;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    public function index()
    {
        $repository = $this->getDoctrine()
            ->getRepository(Restaurant::class);

        $restaurants = $repository->findBy([]);

        return $this->render('front/index.html.twig', [
            'restaurants' => $restaurants
        ]);
    }

    /**
     * Page permettant d'afficher les menus d'un restaurant
     * @Route("/restaurant/{libellerestaurant}", name="index_restaurant", methods={"GET"})
     * @param $libellerestaurant
     * @return Response
     */
    public function restaurant($libellerestaurant = 'indien')
    {
        return new Response("<html><body><h1>PAGE RESTAURANT: $libellerestaurant</h1></body></html>");
    }
}