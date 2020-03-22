<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\NotBlank;

class TicketType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Titre de la demande'
                ],
                'constraints' => [
                    new NotBlank(['message' => 'Merci de saisir le titre de votre demande'])
                ]
            ])
            ->add('description', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Description'
                ],
                'constraints' => [
                    new NotBlank(['message' => 'Merci de saisir une description'])
                ]
            ])
            ->add('postcode', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Code postal (si la demande ne vaut que pour un lieu géographique donné)'
                ],
                'required' => false
            ])
            ->add('contact', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Contact'
                ],
                'constraints' => [
                    new NotBlank(['message' => 'Merci de saisir votre contact'])
                ]
            ])
            ->add('rgpdAccepted', CheckboxType::class, [
                'label' => 'J\'accepte que mes données personnelles soient utilisées pour être contacté par des bénévoles tout en sachant que je pourrais modifier ou supprimer ces coordonnées en modifiant ma demande.',
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter l\'utilisation de vos données personnelles.'
                    ])
                ]
            ])
            ->add('valider', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-perso mx-auto rounded-0'
                ]
            ]);
    }
}
