<?php

namespace App\Form;

use App\Entity\Etudiant;
use App\Entity\Session;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EtudiantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom de famille'
            ])
            ->add('prenom', TextType::class, [
                'label' => 'Prénom'
            ])
            ->add('email', EmailType::class, [
                'label' => 'Adresse Email'
            ])

            ->add('dateNaissance', DateType::class, [
                'label' => 'Date de naissance',
                'widget' => 'single_text',
                'required' => false
            ])

            ->add('session', EntityType::class, [
                'class' => Session::class,
                'choice_label' => function (Session $session) {
                    return $session->getDiplome()->getIntitule() . ' - ' . $session->getAnnee();
                },
                'label' => 'Session d\'examen',
                'placeholder' => 'Choisir une session...'
            ])
            ->add('moyenne', NumberType::class, [
                'label' => 'Moyenne obtenue',
                'required' => false,
                'scale' => 2,
                'attr' => ['placeholder' => 'Ex: 14.50']
            ])
            ->add('estAdmis', CheckboxType::class, [
                'label' => 'L\'étudiant est-il admis ?',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Etudiant::class,
        ]);
    }
}
