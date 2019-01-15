<?php
/**
 * Created by PhpStorm.
 * User: iso-h
 * Date: 07/01/2019
 * Time: 14:49
 */

namespace App\Controller\fplq;


use App\Entity\Membre;
use App\Form\MembreFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Role\RoleHierarchyInterface;

class MembreController extends AbstractController
{
    /**
     * @Route("/inscription", name="membre_inscription")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function inscription(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        # création d'un membre
        $membre = new Membre();
         $membre->setRoles(['ROLE_MEMBRE']);

        # creation du formulaire MembreFormType
        $form = $this->createForm(MembreFormType::class, $membre)
            ->handleRequest($request);

        # Soumission du Formulaire
        if ($form->isSubmitted() && $form->isValid()) {

            # Encodage du mot de passe
            $membre->setPassword($passwordEncoder
                ->encodePassword($membre, $membre->getPassword()));

            #methode permettant de creer un utilisateur en ADMIN
            #$membre->addRole("ROLE_ADMIN");

            # Sauvegarde en BDD
            $em = $this->getDoctrine()->getManager();
            $em->persist($membre);
            $em->flush();

            # Notification
            $this->addFlash('notice_inscription',
                'Félicitations, votre inscription a bien été validée!');

            # Redirection
            return $this->redirectToRoute('security_connexion');
        }
        # Affichage dans la Vue
        return $this->render('membre/inscription.html.twig', [
            'form' => $form->createView()
        ]);
    }
}