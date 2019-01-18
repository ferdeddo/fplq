<?php
namespace App\Controller\fplq;


use App\Controller\HelperTrait;
use App\Form\ContactFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController

{
    use HelperTrait;

    /**
     * @Route("/index", name="formulaire_contact")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function formulaire(Request $request)
    {

        # Création du formulaire ContactFormType
        $form_contact = $this->createForm(ContactFormType::class)
            ->handleRequest($request);


        # Affichage dans la Vue
        return $this->render('front/index.html.twig', [
            'form_contact' => $form_contact->createView()
        ]);


    }
}

