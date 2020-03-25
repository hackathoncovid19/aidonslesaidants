<?php

namespace App\Form;

use App\Entity\Ticket;
use App\Enum\TicketStatusEnum;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

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
                    new NotNull(),
                    new NotBlank(['message' => 'Merci de saisir le titre de votre demande'])
                ],
                'empty_data' => '',
            ])
            ->add('description', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Description'
                ],
                'constraints' => [
                    new NotNull(),
                    new NotBlank(['message' => 'Merci de saisir une description'])
                ],
                'empty_data' => '',
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
                    new NotNull(),
                    new NotBlank(['message' => 'Merci de saisir votre contact'])
                ],
                'empty_data' => '',
            ])
            ->add('valider', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-perso mx-auto rounded'
                ]
            ]);


        $builder->addEventListener(FormEvents::PRE_SET_DATA, [$this, 'onPreSetData']);
    }

    /**
     * @param FormEvent $event
     */
    public function onPreSetData(FormEvent $event)
    {
        /** @var $ticket $ticket */
        $ticket = $event->getData();
        $form = $event->getForm();
        if (!$ticket || null !== $ticket->getId()) {
            $form
                ->add('status', ChoiceType::class, [
                    'choices' => $this->getStatusChoices(),
                    'attr' => [
                        'class' => 'form-control',
                        'placeholder' => 'Statut',
                    ],
                    'required' => true,
                    'constraints' => [
                        new NotNull(),
                        new NotBlank(),
                    ],
                    'empty_data' => '',
                ]);
        } else {
            $form->add('rgpdAccepted', CheckboxType::class, [
                'label' => 'J\'accepte que mes données personnelles soient utilisées pour être contacté par des bénévoles tout en sachant que je pourrais modifier ou supprimer ces coordonnées en modifiant ma demande.',
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter l\'utilisation de vos données personnelles.'
                    ])
                ]
            ]);
        }
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ticket::class,
        ]);
    }

    /**
     * @return array
     */
    private function getStatusChoices(): array
    {
        $statuses = TicketStatusEnum::TICKET_STATUS_DATA;
        $data = [];
        foreach ($statuses as $statusKey => $status) {
            $data[$status['name']] = $statusKey;
        }
        return $data;
    }
}
