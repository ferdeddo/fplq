<?php
/**
 * Created by PhpStorm.
 * User: iso-h
 * Date: 09/01/2019
 * Time: 11:00
 */

namespace App\Controller\fplq;

use App\Controller\HelperTrait;
use App\Entity\Restaurant;
use App\Form\ContactFormType;
use App\Form\RestaurantFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class RestaurantController extends AbstractController
{
    use HelperTrait;

    /**
     * @Security("has_role('ROLE_ADMIN')")
     * @Route("/admin/inscription_restaurant", name="restaurant_inscription")
     */
    public function inscription(Request $request, \Swift_Mailer $mailer)
    {
        # Création d'un restaurant
        $restaurant = new Restaurant();

        # Création du formulaire RestaurantFormType
        $form = $this->createForm(RestaurantFormType::class, $restaurant)
            ->handleRequest($request);

        # Création du formulaire ContactFormType
        $form_contact = $this->createForm(ContactFormType::class)
            ->handleRequest($request);

        # Soumission des Formulaires
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
            return $this->redirectToRoute('restaurant_inscription');
        }

        if ($form->isSubmitted() && $form->isValid()) {

            // $photo stores the uploaded file
            /** @var UploadedFile $photo */
            $photo = $restaurant->getPhoto();

            $fileName = $this->slugify($restaurant->getNom()). '.' .$photo->guessExtension();

            // Move the file to the directory where images are stored
            try {
                $photo->move(
                    $this->getParameter('restaurants_assets_dir'),
                    $fileName
                );
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }

            # Mise à jour de l'image
            $restaurant->setPhoto($fileName);

            # Mise à jour du slug
            $restaurant->setSlug($this->slugify($restaurant->getNom()));

            # Sauvegarde en BDD
            $em = $this->getDoctrine()->getManager();
            $em->persist($restaurant);
            $em->flush();

            # Notification
            $this->addFlash('notice_inscription',
                'Félicitations, votre restaurant a bien été ajouté!');

            # Redirection
            return $this->redirectToRoute('index');
        }
        # Affichage dans la Vue
        return $this->render('restaurant/inscription.html.twig', [
            'form' => $form->createView(),
            'form_contact' => $form_contact->createView(),
        ]);

    }
}