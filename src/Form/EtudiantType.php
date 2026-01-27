<?php

namespace App\Form;

use App\Entity\Etudiant;
use App\Entity\Session;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EtudiantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, ['label' => 'Nom'])
            ->add('prenom', TextType::class, ['label' => 'Prénom'])
            ->add('email', EmailType::class, ['label' => 'Adresse Email'])

            ->add('session', EntityType::class, [
                'class' => Session::class,
                'label' => 'Session d\'examen',
                'choice_label' => function (Session $session) {
                    return $session->getDiplome()->getIntitule() . ' - ' . $session->getAnnee();
                },
            ])

            ->add('resultat', ChoiceType::class, [
                'label' => 'Résultat',
                'required' => false,
                'placeholder' => 'En attente de résultat...',
                'choices'  => [
                    'Admis' => 'Admis',
                    'Rattrapage' => 'Rattrapage',
                    'Refusé' => 'Refusé',
                ],
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
