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
    public function index(Request $request, \Swift_Mailer $mailer)
    {

        $repository = $this->getDoctrine()
            ->getRepository(Restaurant::class);

        $restaurants = $repository->findBy([]);

        # creation du formulaire FormulaireFormType
        $form = $this->createForm(FormulaireFormType::class)
            ->handleRequest($request);

        # Soumission du Formulaire
        if ($form->isSubmitted() && $form->isValid()){

            $data = $form->getData([]);

            $message = (new \Swift_Message('Hello Email'))
                ->setFrom($data['email'])
                ->setTo('b3547af6c0-44c0b6@inbox.mailtrap.io')
                ->setBody("Merci de bien vouloir prendre contact avec l'expediteur afin d'inscrire son restaurant en base de données !".
                  '<br>'. $data['nom'].'<br>'.$data['prenom'].'<br>'.$data['email'].'<br>'.$data['tel'],
//                    $this->renderView(
//                    // templates/emails/registration.html.twig
//                        'emails/registration.html.twig',
//                        array('name' => $name)
//                    ),
                    'text/html'
                );

            $mailer->send($message);

//            b3547af6c0-44c0b6@inbox.mailtrap.io

            # Notification
            $this->addFlash('notice_inscription',
                'Félicitations, votre envoi a bien été validé, un commercial vous contactera dans 24h!');

            # Redirection
            return $this->redirectToRoute('index');
        }

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

        # creation du formulaire FormulaireFormType
        $form = $this->createForm(FormulaireFormType::class)
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
        $repository = $this->getDoctrine()
            ->getRepository(Restaurant::class);

        $restaurants = $repository->findBy([]);

        # creation du formulaire FormulaireFormType
        $form = $this->createForm(FormulaireFormType::class)
            ->handleRequest($request);

        return $this->render('front/menuRestaurants.html.twig', [
            'restaurants' => $restaurants,
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
