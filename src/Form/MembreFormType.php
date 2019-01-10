<?php
/**
 * Created by PhpStorm.
 * User: iso-h
 * Date: 07/01/2019
 * Time: 14:42
 */

namespace App\Form;


use App\Entity\Membre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MembreFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom', TextType::class, [
                'label'=>"Nom",
                'attr'=> [
                    'placeholder'=>"Entrez votre nom"
                ]
            ])

            ->add('prenom', TextType::class, [
                'label'=>"Prénom",
                'attr'=> [
                    'placeholder'=>"Entrez votre prénom"
                ]
            ])

            ->add('email', EmailType::class, [
                'label'=>"Email",
                'attr'=> [
                    'placeholder'=>"Entrez votre Email"
                ]
            ])

            ->add('password', PasswordType::class, [
                'label' => "Mot de passe",
                'attr' => [
                    'placeholder' => "Entrez votre mot de passe"
                ]
            ])

            ->add('submit', SubmitType::class,
                [
                    'label'=>"M'inscrire",
                    'attr' => array ( 'class' => 'submit' )

                ]);
    }
             public function configureOptions(OptionsResolver $resolver)
             {
                 $resolver->setDefaults([
                 'data_class' => Membre::class
                 ]);
             }
}