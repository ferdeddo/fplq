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
            'label'=>"nom",
            'attr'=> [
                'placeholder'=>'Entrez le nom du restaurant'
            ]
        ])
            ->add('code_postal', TextType::class, [
                'label'=>'code postal',
                'attr'=> [
                    'placeholder'=>"Entrez le code postal du restaurant"
                ]
            ])

            ->add('adresse', TextareaType::class, [
                'label'=>"adresse",
                'attr'=> [
                    'placeholder'=>'Entrez la    adresse'
                ]
            ])

            ->add('ville', TextType::class, [
                'label'=>"ville",
                'attr'=> [
                    'placeholder'=>'Entrez la ville'
                ]
            ])

            ->add('horaires', TextType::class, [
                'label'=>"horaires",
                'attr'=> [
                    'placeholder'=>"Horaires d'ouverture"
                ]
            ])

            ->add('commande_min', TextType::class, [
                'label'=>"commande minimum",
                'attr'=> [
                    'placeholder'=>'Commande minimum'
                ]
            ])

            ->add('prix_livraison', TextType::class, [
                'label'=>"prix livraison",
                'attr'=> [
                    'placeholder'=>'Prix de livraison'
                ]
            ])

            ->add('photo', FileType::class, [
                'label'=>"photos",
                'attr'=> [
                    'class' => 'dropify'
                ]
            ])

            ->add('description', TextareaType::class, [
                'label'=>"description",
                'attr'=> [
                    'placeholder'=>'Description'
                ]
            ])

            ->add('type', EntityType::class, [
                'class' => Type::class,
                'choice_label' => 'nom',
                'label'=>"type",
                'attr'=> [
                    'placeholder'=>'Type de restaurant'
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