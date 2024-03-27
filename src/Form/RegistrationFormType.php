<?php

namespace App\Models;

use App\Entity\Address;
use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'First Name*',
                'required' => true,
                'attr' => [
                    'class' => 'ec-register-input',
                    'placeholder' => 'Enter your first name',
                ],
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Last Name*',
                'required' => true,
                'attr' => [
                    'class' => 'ec-register-input',
                    'placeholder' => 'Enter your last name',
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email*',
                'required' => true,
                'attr' => [
                    'class' => 'ec-register-input',
                    'placeholder' => 'Enter your email add...',
                ],
            ])
            ->add('phonenumber', TextType::class, [
                'label' => 'Phone Number*',
                'required' => true,
                'attr' => [
                    'class' => 'ec-register-input',
                    'placeholder' => 'Enter your phone number',
                ],
            ])
            ->add('gender', ChoiceType::class, [
                'label' => 'Gender*',
                'choices' => [
                    'Male' => 'male',
                    'Female' => 'female',
                ],
                'required' => true,
                'attr' => [
                    'class' => 'ec-register-select',
                    'id' => 'Gender',
                ],
            ])
            ->add('address', TextType::class, [
                'label' => 'Address',
                'required' => false,
                'attr' => [
                    'class' => 'ec-register-input',
                    'placeholder' => 'Address',
                ],
            ])
            ->add('country', ChoiceType::class, [
                'label' => 'Country*',
                'required' => true,
                'attr' => [
                    'class' => 'ec-register-select',
                    'id' => 'ec-select-country',
                    'onchange' => 'populateStates()',
                ],
            ])
            ->add('state', ChoiceType::class, [
                'label' => 'Region/State*',
                'required' => true,
                'attr' => [
                    'class' => 'ec-register-select',
                    'id' => 'ec-select-state',
                    'onchange' => 'populateCities()',
                ],
            ])
            ->add('city', ChoiceType::class, [
                'label' => 'City*',
                'required' => true,
                'attr' => [
                    'class' => 'ec-register-select',
                    'id' => 'ec-select-city',
                ],
            ])
            ->add('postalcode', TextType::class, [
                'label' => 'Post Code',
                'required' => false,
                'attr' => [
                    'class' => 'ec-register-input',
                    'placeholder' => 'Post Code',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
