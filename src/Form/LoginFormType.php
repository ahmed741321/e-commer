<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoginFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Email Address*',
                'attr' => [
                    'class' => 'ec-login-wrap',
                    'placeholder' => 'Enter your email add...',
                ],
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Password*',
                'attr' => [
                    'class' => 'ec-login-wrap',
                    'placeholder' => 'Enter your password',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => null,
        ]);
    }
}
