<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'username',
                TextType::class,
                [
                    'constraints'=> [new NotBlank(), new NotNull()],
                    'attr' => [
                        'class' => 'form-control',
                        'placeholder' => 'Pseudonyme'
                    ],
                    'required' => true,
                ]
            )
            ->add(
                'password',
                RepeatedType::class,
                [
                    'type' => PasswordType::class,
                    'invalid_message' => 'The password fields must match',
                    'required' => true,
                    'first_options' => [
                        'label' => '',
                        'attr' => [
                            'class' => 'form-control',
                            'placeholder' => 'Mot de passe'
                        ]
                    ],
                    'second_options' => [
                        'attr' => [
                            'class' => 'form-control',
                            'placeholder' => 'Confirmation du mot de passe'
                        ]
                    ]
                ]
            );
  }
}
