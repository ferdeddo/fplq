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
     * Page permettant d'afficher la liste des restaurant
     * @Route("/listerestaurant", name="index_restaurant")
     */
    public function listerestaurants()
    {
        return $this->render('front/ListeRestaurants.html.twig');
    }

    /**
     * Page permettant d'afficher la liste des restaurant
     * @Route("/menu", name="index_menu")
     */
    public function menu()
    {
        return $this->render('front/MenuRestaurants.html.twig');
    }
}