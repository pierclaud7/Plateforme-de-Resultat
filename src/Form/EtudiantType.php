<?php

namespace App\Form;

use App\Entity\Etudiant;
use App\Entity\Session;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType; // Pour la case à cocher
use Symfony\Component\Form\Extension\Core\Type\NumberType;   // Pour la moyenne
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
            ->add('email', TextType::class, [
                'label' => 'Adresse Email'
            ])
            // Ajout du champ Session (Menu déroulant)
            ->add('session', EntityType::class, [
                'class' => Session::class,
                'choice_label' => function (Session $session) {
                    // Affiche "BTS SIO - 2025" dans la liste
                    return $session->getDiplome()->getIntitule() . ' - ' . $session->getAnnee();
                },
                'label' => 'Session d\'examen',
                'placeholder' => 'Choisir une session...'
            ])
            // Ajout du champ Moyenne
            ->add('moyenne', NumberType::class, [
                'label' => 'Moyenne obtenue',
                'required' => false, // Pas obligatoire à l'inscription
                'scale' => 2, // 2 chiffres après la virgule
                'attr' => ['placeholder' => 'Ex: 14.50']
            ])
            // Ajout de la case "Admis"
            ->add('estAdmis', CheckboxType::class, [
                'label' => 'L\'étudiant est-il admis ?',
                'required' => false, // Une case à cocher n'est jamais "obligatoire" au sens HTML
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
