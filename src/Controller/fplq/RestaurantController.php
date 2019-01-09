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
use App\Form\RestaurantFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class RestaurantController extends AbstractController
{
    use HelperTrait;

    /**
     * @Route("/inscription_restaurant", name="restaurant_inscription")
     */

    public function inscription(Request $request)
    {
        # création d'un restaurant
        $restaurant = new Restaurant();

        # creation du formulaire MembreFormType
        $form = $this->createForm(RestaurantFormType::class, $restaurant)
            ->handleRequest($request);

        # Soumission du Formulaire
        if ($form->isSubmitted() && $form->isValid()) {

            # 1. Traitement de l'upload de l'image

            // $featuredImage stores the uploaded file
            /** @var UploadedFile $photo */
            $photo = $restaurant->getPhoto();

            $fileName = $this->slugify($restaurant->getPhoto());
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
            'form' => $form->createView()
        ]);

    }
}