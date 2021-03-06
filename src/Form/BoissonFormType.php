<?php
/**
 * Created by PhpStorm.
 * User: iso-h
 * Date: 09/01/2019
 * Time: 12:08
 */

namespace App\Form;


use App\Entity\Boisson;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BoissonFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('nom', TextType::class, [
                'label'=>"Nom",
                'attr'=> [
                    'placeholder'=>"Nom"
                ]
            ])

            ->add('description', TextareaType::class, [
                'label'=>"Description",
                'attr'=> [
                    'placeholder'=>"Description"
                ]
            ])

            ->add('prix', TextType::class, [
                'label'=>"Prix",
                'attr'=> [
                    'placeholder'=>"Prix"
                ]
            ])

            ->add('photo', FileType::class, [
                'label'=>"Photo",
                'attr'=> [
                    'class' => "dropify"
                ]
            ])

            ->add('submit', SubmitType::class,
                [
                    'label'=>"Ajouter ma boisson",
                    'attr' => array ( 'class' => 'submit' )
                ]);
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Boisson::class
        ]);
    }
}