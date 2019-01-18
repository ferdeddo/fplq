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
    /**
     * Page d'Accueil
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request, \Swift_Mailer $mailer)
    {

        $repository = $this->getDoctrine()
            ->getRepository(Restaurant::class);

        $restaurants = $repository->findBy([]);

        # Création du formulaire ContactFormType
        $form_contact = $this->createForm(ContactFormType::class)
            ->handleRequest($request);

        # Soumission du Formulaire
        if ($form_contact->isSubmitted() && $form_contact->isValid()) {

            # Récupération des données pour SwiftMailer
            $data = $form_contact->getData([]);

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

//          b3547af6c0-44c0b6@inbox.mailtrap.io

            # Notification
            $this->addFlash('notice_inscription',
                'Félicitations, votre envoi a bien été validé, un commercial vous contactera très prochainement!');

            # Redirection
            return $this->redirectToRoute('index');
        }

        return $this->render('front/index.html.twig', [
            'restaurants' => $restaurants,
            'form_contact' => $form_contact->createView()
        ]);
    }

    /**
     * Page permettant d'afficher les restaurants
     * @Route("/listerestaurants", name="index_restaurant")
     */
    public function listeRestaurants(Request $request, \Swift_Mailer $mailer)
    {
        $repository = $this->getDoctrine()
            ->getRepository(Restaurant::class);

        $restaurants = $repository->findBy([]);

        # Création du formulaire ContactFormType
        $form_contact = $this->createForm(ContactFormType::class)
            ->handleRequest($request);

        # Soumission du Formulaire
        if ($form_contact->isSubmitted() && $form_contact->isValid()) {

            # Récupération des données pour SwiftMailer
            $data = $form_contact->getData([]);

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

//          b3547af6c0-44c0b6@inbox.mailtrap.io

            # Notification
            $this->addFlash('notice_inscription',
                'Félicitations, votre envoi a bien été validé, un commercial vous contactera très prochainement!');

            # Redirection
            return $this->redirectToRoute('index_restaurant');
        }

        return $this->render('front/ListeRestaurants.html.twig', [
            'restaurants' => $restaurants,
            'form_contact' => $form_contact->createView()
        ]);
    }

    /**
     * Page permettant d'afficher les menus d'un restaurant
     * @Route("/menu_restaurant/{id<\d+>}", name="index_menu")
     * @param Request $request
     * @param Restaurant $restaurant
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function menuRestaurants(Request $request, Restaurant $restaurant, \Swift_Mailer $mailer)
    {
        $repository_entrees = $this->getDoctrine()
            ->getRepository(Entree::class);

        $repository_menus = $this->getDoctrine()
            ->getRepository(Menu::class);

        $repository_desserts = $this->getDoctrine()
            ->getRepository(Dessert::class);

        $repository_boissons = $this->getDoctrine()
            ->getRepository(Boisson::class);

        $entrees = $repository_entrees->findBy([]);
        $menus = $repository_menus->findBy([]);
        $desserts = $repository_desserts->findBy([]);
        $boissons = $repository_boissons->findBy([]);

        # Création du formulaire ContactFormType
        $form_contact = $this->createForm(ContactFormType::class)
            ->handleRequest($request);

        # Soumission du Formulaire
        if ($form_contact->isSubmitted() && $form_contact->isValid()) {

            # Récupération des données pour SwiftMailer
            $data = $form_contact->getData([]);

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

//          b3547af6c0-44c0b6@inbox.mailtrap.io

            # Notification
            $this->addFlash('notice_inscription',
                'Félicitations, votre envoi a bien été validé, un commercial vous contactera très prochainement!');

            # Redirection
            return $this->redirectToRoute('index_menu');
        }

        return $this->render('front/MenuRestaurants.html.twig', [
            'restaurant' => $restaurant,
            'entrees' => $entrees,
            'menus' => $menus,
            'desserts' => $desserts,
            'boissons' => $boissons,
            'form_contact' => $form_contact->createView()
        ]);
    }

    /**
     * Page permettant d'afficher le profil de l'utilisateur connecté
     * @Route("/profil", name="profil")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function profil(Request $request, \Swift_Mailer $mailer)
    {
        # Création du formulaire ContactFormType
        $form_contact = $this->createForm(ContactFormType::class)
            ->handleRequest($request);

        # Soumission du Formulaire
        if ($form_contact->isSubmitted() && $form_contact->isValid()) {

            # Récupération des données pour SwiftMailer
            $data = $form_contact->getData([]);

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

//          b3547af6c0-44c0b6@inbox.mailtrap.io

            # Notification
            $this->addFlash('notice_inscription',
                'Félicitations, votre envoi a bien été validé, un commercial vous contactera très prochainement!');

            # Redirection
            return $this->redirectToRoute('profil');
        }

        return $this->render('membre/profil.html.twig', [
            'form_contact' => $form_contact->createView()
        ]);
    }
}
