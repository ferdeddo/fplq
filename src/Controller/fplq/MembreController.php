<?php
/**
 * Created by PhpStorm.
 * User: iso-h
 * Date: 07/01/2019
 * Time: 14:49
 */

namespace App\Controller\fplq;


use App\Controller\HelperTrait;
use App\Entity\Membre;
use App\Form\ContactFormType;
use App\Form\MembreFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Routing\Annotation\Route;

class MembreController extends AbstractController
{
    use HelperTrait;

    /**
     * @Route("/inscription", name="membre_inscription")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function inscription(Request $request, UserPasswordEncoderInterface $passwordEncoder, \Swift_Mailer $mailer)
    {
        # Création d'un membre
        $membre = new Membre();
        $membre->setRoles(['ROLE_MEMBRE']);

        # Création du formulaire MembreFormType
        $form = $this->createForm(MembreFormType::class, $membre)
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
            return $this->redirectToRoute('membre_inscription');
        }


        if ($form->isSubmitted() && $form->isValid()) {

            // $photo stores the uploaded file
            /** @var UploadedFile $photo */
            $photo = $membre->getPhoto();

            $fileName = $this->slugify($membre->getPrenom()). '-' . $this->slugify($membre->getNom()). '.' .$photo->guessExtension();

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
            $membre->setPhoto($fileName);

            # Encodage du mot de passe
            $membre->setPassword($passwordEncoder
                ->encodePassword($membre, $membre->getPassword()));

            #methode permettant de créer un utilisateur en ADMIN
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
            'form' => $form->createView(),
            'form_contact' => $form_contact->createView()
        ]);
    }
}