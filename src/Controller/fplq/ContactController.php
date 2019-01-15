<?php
/**
 * Created by PhpStorm.
 * User: iso-h
 * Date: 14/01/2019
 * Time: 11:28
 */

namespace App\Controller\fplq;


use App\Controller\HelperTrait;
use App\Form\FormulaireFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController

{
    use HelperTrait;
    /**
     * @Route("/index", name="formulaire_contact")
     */

    public function formulaire(Request $request)
    {

        # creation du formulaire ContactFormType
        $form = $this->createForm(ContactFormType::class)
            ->handleRequest($request);

        # Soumission du Formulaire
        if ($form->isSubmitted() && $form->isValid()){

            # Notification
            $this->addFlash('notice_inscription',
                'Félicitations, votre envoi a bien été validé, un commercial vous contactera dans 24h!');

            # Redirection
            return $this->redirectToRoute('index');
        }
        # Affichage dans la Vue
        return $this->render('front/index.html.twig', [
            'form' => $form->createView()
        ]);


    }
}

