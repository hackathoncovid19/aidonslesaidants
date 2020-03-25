<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserType extends AbstractType
{
    /**
     * TODO use DTO instead entity to avoid to remove entity type hinting
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
                    'label' => 'Identifiant',
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Veuillez saisir un identifiant'
                        ]),
                    ],
                    'attr' => [
                        'class' => 'form-control',
                        'placeholder' => ''
                    ],
                    'required' => true,
                    'empty_data' => ''
                ],
                )
            ->add(
                'password',
                RepeatedType::class,
                [
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Veuillez saisir votre mot de passe'
                        ]),
                    ],
                    'type' => PasswordType::class,
                    'invalid_message' => 'Les mots de passe ne correspondent pas.',
                    'required' => true,
                    'first_options' => [
                        'label' => 'Mot de passe',
                        'attr' => [
                            'class' => 'form-control',
                            'placeholder' => ''
                        ],
                    ],
                    'second_options' => [
                        'label' => 'Confirmation du mot de passe',
                        'attr' => [
                            'class' => 'form-control',
                            'placeholder' => ''
                        ]
                    ],
                ]
            );
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
