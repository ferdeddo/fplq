<?php
namespace App\Controller\fplq;


use App\Controller\HelperTrait;
use App\Form\FormulaireFormType;
use Swift_Mailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FormulaireController extends AbstractController

{
    use HelperTrait;

    /**
     * @Route("/index", name="formulaire_contact")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */

    public function formulaire(Request $request)
    {

        # creation du formulaire RestaurantFormType
        $form = $this->createForm(FormulaireFormType::class)
            ->handleRequest($request);


        # Affichage dans la Vue
        return $this->render('front/index.html.twig', [
            'form' => $form->createView()
        ]);


        }
    }

