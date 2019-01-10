<?php
/**
 * Created by PhpStorm.
 * User: iso-h
 * Date: 09/01/2019
 * Time: 12:08
 */

namespace App\Form;


use App\Entity\Restaurant;
use App\Entity\Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RestaurantFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('nom', TextType::class, [
            'label'=>"Nom",
            'attr'=> [
                'placeholder'=>"Entrez le nom du restaurant"
            ]
        ])

            ->add('adresse', TextareaType::class, [
                'label'=>"Adresse",
                'attr'=> [
                    'placeholder'=>"Entrez l'adresse du restaurant"
                ]
            ])

            ->add('code_postal', TextType::class, [
                'label'=>'Code postal',
                'attr'=> [
                    'placeholder'=>"Entrez le code postal du restaurant"
                ]
            ])

            ->add('ville', TextType::class, [
                'label'=>"Ville",
                'attr'=> [
                    'placeholder'=>'Entrez la ville'
                ]
            ])

            ->add('horaires', TextType::class, [
                'label'=>"Horaires",
                'attr'=> [
                    'placeholder'=>"Horaires d'ouverture"
                ]
            ])

            ->add('commande_min', TextType::class, [
                'label'=>"Commande minimum",
                'attr'=> [
                    'placeholder'=>"Commande minimum"
                ]
            ])

            ->add('prix_livraison', TextType::class, [
                'label'=>"Prix livraison",
                'attr'=> [
                    'placeholder'=>"Prix de livraison"
                ]
            ])

            ->add('photo', FileType::class, [
                'label'=>"Photo",
                'attr'=> [
                    'class' => "dropify"
                ]
            ])

            ->add('description', TextareaType::class, [
                'label'=>"Description",
                'attr'=> [
                    'placeholder'=>"Description"
                ]
            ])

            ->add('type', EntityType::class, [
                'class' => Type::class,
                'choice_label' => 'nom',
                'label'=>"Type",
                'attr'=> [
                    'placeholder'=>"Type de restaurant"
                ]
            ])

            ->add('submit', SubmitType::class,
                [
                    'label'=>"Inscrire mon restaurant"
                ]);
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Restaurant::class
        ]);
    }
}