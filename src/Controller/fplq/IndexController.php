<?php
/**
 * Created by PhpStorm.
 * User: Ferdeddo
 * Date: 27/12/2018
 * Time: 11:53
 */

namespace App\Controller\fplq;


use Doctrine\DBAL\Types\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
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
     * @Route("/listerestaurant", name="index_restaurant")
     */
    public function listerestaurants()
    {
        return $this->render('front/ListeRestaurants.html.twig');
    }
}