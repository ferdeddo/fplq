<?php
/**
 * Created by PhpStorm.
 * User: PC11
 * Date: 03/01/2019
 * Time: 12:22
 */

namespace App\Controller\fplq\Security;

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
    public function connexion( AuthenticationUtils $authenticationUtils)
    {
        # Création du Formulaire LoginFormType
        $form = $this->createForm(LoginFormType::class, [
            'email' => $authenticationUtils->getLastUsername()
        ]);

        # Récupération du message d'erreur
        $error = $authenticationUtils->getLastAuthenticationError();

        # Notification
        $this->addFlash('notice_inscription',
            'Bonjour ! vous êtes connecté.');

        # Dernier email saisi par l'utilisateur.
        $lastEmail = $authenticationUtils->getLastUsername();



        return $this->render('security/connexion.html.twig', [
            'form' => $form->createView(),
//            'last_email' => $lastEmail,
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