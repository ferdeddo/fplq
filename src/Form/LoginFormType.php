<?php
/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 2019-01-09
 * Time: 12:17
 */

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoginFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('email', EmailType::class, [
            'label' => "Email",
            'attr' => [
                'placeholder' => "Email"
            ]
        ])
            ->add('mdp', PasswordType::class, [
                'label' => "Mot de passe",
                'attr' => [
                    'placeholder' => "Mot de passe"
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => "Me connecter"
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => null
        ]);
    }

    public function getBlockPrefix()
    {
        return 'app_login';
    }


}