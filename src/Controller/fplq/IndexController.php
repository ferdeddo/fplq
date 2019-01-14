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
use App\Form\FormulaireFormType;
use App\Form\RestaurantFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    public function index(Request $request)
    {

        $repository = $this->getDoctrine()
            ->getRepository(Restaurant::class);

        $restaurants = $repository->findBy([]);

        # creation du formulaire RestaurantFormType
        $form = $this->createForm(FormulaireFormType::class)
            ->handleRequest($request);

        return $this->render('front/index.html.twig', [
            'restaurants' => $restaurants,
            'form' => $form->createView()
        ]);
    }

    /**
     * Page permettant d'afficher les restaurants
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
     * Page permettant d'afficher les menus d'un restaurant
     * @Route("/menurestaurants", name="index_menu")
     */
    public function menurestaurants()
    {
        $repository = $this->getDoctrine()
            ->getRepository(Restaurant::class);

        $restaurants = $repository->findBy([]);

        return $this->render('front/menuRestaurants.html.twig', [
            'restaurants' => $restaurants
        ]);
    }

    /**
     * Page permettant d'afficher les menus d'un restaurant
     * @Route("/interface_user", name="index_interface_user")
     */
    public function InterfaceUser()
    {
        return $this->render('membre/InterfaceUser.html.twig');
    }
}
