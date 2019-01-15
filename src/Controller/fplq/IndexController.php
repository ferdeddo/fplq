<?php
/**
 * Created by PhpStorm.
 * User: Ferdeddo
 * Date: 27/12/2018
 * Time: 11:53
 */

namespace App\Controller\fplq;


use App\Entity\Boisson;
use App\Entity\Dessert;
use App\Entity\Entree;
use App\Entity\Menu;
use App\Entity\Restaurant;
use App\Form\ContactFormType;
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

        # creation du formulaire ContactFormType
        $form = $this->createForm(ContactFormType::class)
            ->handleRequest($request);

        return $this->render('front/index.html.twig', [
            'restaurants' => $restaurants,
            'form' => $form->createView()
        ]);
    }

    /**
     * Page permettant d'afficher les restaurants
     * @Route("membre/listerestaurants", name="index_restaurant")
     */
    public function listerestaurants(Request $request)
    {
        $repository = $this->getDoctrine()
            ->getRepository(Restaurant::class);

        $restaurants = $repository->findBy([]);

        # creation du formulaire ContactFormType
        $form = $this->createForm(ContactFormType::class)
            ->handleRequest($request);

        return $this->render('front/ListeRestaurants.html.twig', [
            'restaurants' => $restaurants,
            'form' => $form->createView()
        ]);
    }
    /**
     * Page permettant d'afficher les menus d'un restaurant
     * @Route("/menurestaurants", name="index_menu")
     */
    public function menurestaurants(Request $request)
    {
        $repository_restaurants = $this->getDoctrine()
            ->getRepository(Restaurant::class);

        $repository_entrees = $this->getDoctrine()
            ->getRepository(Entree::class);

        $repository_menus = $this->getDoctrine()
            ->getRepository(Menu::class);

        $repository_desserts = $this->getDoctrine()
            ->getRepository(Dessert::class);

        $repository_boissons = $this->getDoctrine()
            ->getRepository(Boisson::class);

        $restaurants = $repository_restaurants->findBy([]);
        $entrees = $repository_entrees->findBy([]);
        $menus = $repository_menus->findBy([]);
        $desserts = $repository_desserts->findBy([]);
        $boissons = $repository_boissons->findBy([]);

        # creation du formulaire ContactFormType
        $form = $this->createForm(ContactFormType::class)
            ->handleRequest($request);

        return $this->render('front/menuRestaurants.html.twig', [
            'restaurants' => $restaurants,
            'entrees' => $entrees,
            'menus' => $menus,
            'desserts' => $desserts,
            'boissons' => $boissons,
            'form' => $form->createView()
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
