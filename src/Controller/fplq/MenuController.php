<?php
/**
 * Created by PhpStorm.
 * User: iso-h
 * Date: 09/01/2019
 * Time: 11:00
 */

namespace App\Controller\fplq;

use App\Controller\HelperTrait;
use App\Entity\Boisson;
use App\Entity\Dessert;
use App\Entity\Entree;
use App\Entity\Menu;
use App\Entity\Restaurant;
use App\Form\BoissonFormType;
use App\Form\DessertFormType;
use App\Form\EntreeFormType;
use App\Form\FormulaireFormType;
use App\Form\MenuFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class MenuController extends AbstractController
{
    use HelperTrait;

    /**
     * @Route("/carte_restaurant/{restaurant}", name="carte_restaurant")
     */


    public function carte(Request $request, Restaurant $restaurant)
    {
        # création d'une entrée, un menu, un dessert ou une boisson
        $entree = new Entree();
        $menu = new Menu();
        $dessert = new Dessert();
        $boisson = new Boisson();

        # Récupération de l'Id du Restaurant
        $entree->setRestaurant($restaurant);
        $menu->setRestaurant($restaurant);
        $dessert->setRestaurant($restaurant);
        $boisson->setRestaurant($restaurant);

        # creation du formulaire FormulaireFormType
        $form = $this->createForm(FormulaireFormType::class)
            ->handleRequest($request);

        # création du formulaire EntreeFormType
        $form_entree = $this->createForm(EntreeFormType::class, $entree)
            ->handleRequest($request);

        # création du formulaire MenuFormType
        $form_menu = $this->createForm(MenuFormType::class, $menu)
            ->handleRequest($request);

        # création du formulaire DessertFormType
        $form_dessert = $this->createForm(DessertFormType::class, $dessert)
            ->handleRequest($request);

        # création du formulaire BoissonFormType
        $form_boisson = $this->createForm(BoissonFormType::class, $boisson)
            ->handleRequest($request);

        # Soumission des Formulaires
        if ($form_entree->isSubmitted() && $form_entree->isValid()) {

            $photo_entree = $entree->getPhoto();
            if(null !== $photo_entree) {
                # 1. Traitement de l'upload de l'image

                // $photo stores the uploaded file
                /** @var UploadedFile $photo_entree */
                $photo_entree = $entree->getPhoto();

                $fileName_entree = $this->slugify($entree->getNom()) . '.' . $photo_entree->guessExtension();

                // Move the file to the directory where images are stored
                try {
                    $photo_entree->move(
                        $this->getParameter('menus_assets_dir'),
                        $fileName_entree
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                # Mise à jour de l'image
                $entree->setPhoto($fileName_entree);
            }

            # Sauvegarde en BDD
            $em = $this->getDoctrine()->getManager();
            $em->persist($entree);
            $em->flush();

            # Notification
            $this->addFlash('notice_entrée',
                'Félicitations, votre entrée a bien été ajoutée!');
        }


            if ($form_menu->isSubmitted() && $form_menu->isValid()) {

                $photo_menu = $menu->getPhoto();
                if(null !== $photo_menu) {
                    # 1. Traitement de l'upload de l'image

                    // $photo stores the uploaded file
                    /** @var UploadedFile $photo_menu */
                    $photo_menu = $menu->getPhoto();

                    $fileName_menu = $this->slugify($menu->getNom()) . '.' . $photo_menu->guessExtension();

                    // Move the file to the directory where images are stored
                    try {
                        $photo_menu->move(
                            $this->getParameter('menus_assets_dir'),
                            $fileName_menu
                        );
                    } catch (FileException $e) {
                        // ... handle exception if something happens during file upload
                    }

                    # Mise à jour de l'image
                    $menu->setPhoto($fileName_menu);
                }

                # Sauvegarde en BDD
                $em = $this->getDoctrine()->getManager();
                $em->persist($menu);
                $em->flush();

                # Notification
                $this->addFlash('notice_menu',
                    'Félicitations, votre menu a bien été ajouté!');
        }


        if ($form_dessert->isSubmitted() && $form_dessert->isValid()) {

            $photo_dessert = $dessert->getPhoto();
            if(null !== $photo_dessert) {
                # 1. Traitement de l'upload de l'image

                // $photo stores the uploaded file
                /** @var UploadedFile $photo_dessert */
                $photo_dessert = $dessert->getPhoto();

                $fileName_dessert = $this->slugify($dessert->getNom()) . '.' . $photo_dessert->guessExtension();

                // Move the file to the directory where images are stored
                try {
                    $photo_dessert->move(
                        $this->getParameter('menus_assets_dir'),
                        $fileName_dessert
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                # Mise à jour de l'image
                $dessert->setPhoto($fileName_dessert);
            }

            # Sauvegarde en BDD
            $em = $this->getDoctrine()->getManager();
            $em->persist($dessert);
            $em->flush();

            # Notification
            $this->addFlash('notice_dessert',
                'Félicitations, votre dessert a bien été ajouté!');
        }

        if ($form_boisson->isSubmitted() && $form_boisson->isValid()) {

            $photo_boisson = $entree->getPhoto();
            if(null !== $photo_boisson) {
                # 1. Traitement de l'upload de l'image

                // $photo stores the uploaded file
                /** @var UploadedFile $photo_boisson */
                $photo_boisson = $boisson->getPhoto();

                $fileName_boisson = $this->slugify($boisson->getNom()) . '.' . $photo_boisson->guessExtension();

                // Move the file to the directory where images are stored
                try {
                    $photo_boisson->move(
                        $this->getParameter('menus_assets_dir'),
                        $fileName_boisson
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                # Mise à jour de l'image
                $boisson->setPhoto($fileName_boisson);
            }

            # Sauvegarde en BDD
            $em = $this->getDoctrine()->getManager();
            $em->persist($boisson);
            $em->flush();

            # Notification
            $this->addFlash('notice_boisson',
                'Félicitations, votre boisson a bien été ajoutée!');
        }

        return $this->render('restaurant/carte.html.twig', [
            'form' => $form->createView(),
            'form_entree' => $form_entree->createView(),
            'form_menu' => $form_menu->createView(),
            'form_dessert' => $form_dessert->createView(),
            'form_boisson' => $form_boisson->createView(),
        ]);

    }
}