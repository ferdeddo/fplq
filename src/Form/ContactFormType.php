<?php
/**
 * Created by PhpStorm.
 * User: iso-h
 * Date: 14/01/2019
 * Time: 11:47
 */

namespace App\Form;


use App\Controller\fplq\ContactController;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactFormType extends AbstractType

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

            ->add('tel', TelType::class, [
                'label'=>"Téléphone",
                'attr'=> [
                    'placeholder'=>"Entrez votre Téléphone"
                ]
            ])

            ->add('submit', SubmitType::class,
                [
                    'label'=>"Envoyer",
                    'attr' => array ( 'class' => 'submit' )

                ]);
    }
//    public function configureOptions(OptionsResolver $resolver)
//    {
//        $resolver->setDefaults([
//            'data_class' => Contact::class
//        ]);
//    }
}