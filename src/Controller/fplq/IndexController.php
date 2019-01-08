<?php
/**
 * Created by PhpStorm.
 * User: Ferdeddo
 * Date: 27/12/2018
 * Time: 11:53
 */

namespace App\Controller\fplq;

use App\Entity\Restaurant;
use App\Entity\Type;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    public function index()
    {
        return $this->render('front/index.html.twig');
    }

    /**
     * Page permettant d'afficher les menus d'un restaurant
     * @Route("/listerestaurants", name="index_restaurant")
     */
    public function listerestaurants()
    {
        $repository = $this->getDoctrine()
            ->getRepository(Restaurant::class);

        $restaurants = $repository->findBy([]);

        return $this->render('front/ListeRestaurants.html.twig', [
            'restaurants' => $restaurants
        ]);
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