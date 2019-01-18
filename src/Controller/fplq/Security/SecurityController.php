<?php
/**
 * Created by PhpStorm.
 * User: PC11
 * Date: 03/01/2019
 * Time: 12:22
 */

namespace App\Controller\fplq\Security;

use App\Form\ContactFormType;
use App\Form\LoginFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * Connexion d'un Membre
     * @Route("/connexion", name="security_connexion")
     * @param AuthenticationUtils $authenticationUtils
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function connexion(Request $request, AuthenticationUtils $authenticationUtils, \Swift_Mailer $mailer)
    {

        # Création du Formulaire LoginFormType
        $form = $this->createForm(LoginFormType::class, [
            'email' => $authenticationUtils->getLastUsername()
        ]);

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
            return $this->redirectToRoute('security_connexion');
        }

        # Récupération du message d'erreur
        $error = $authenticationUtils->getLastAuthenticationError();

        # Notification
        $this->addFlash('notice_connexion',
            'Bonjour! Vous êtes connecté.');

        # Dernier email saisi par l'utilisateur.
        $lastEmail = $authenticationUtils->getLastUsername();

        return $this->render('security/connexion.html.twig', [
            'form' => $form->createView(),
//              'last_email' => $lastEmail,
            'form_contact' => $form_contact->createView(),
            'error' => $error
        ]);


    }

    /**
     * Déconnexion d'un Membre
     * @Route("/deconnexion", name="security_deconnexion")
     */
    public function deconnexion()
    {
    }

    /**
     * Vous pourriez définir ici
     * votre logique mot de passe oublié,
     * réinitialisation du mot de passe,
     * email de validation,...
     */
}