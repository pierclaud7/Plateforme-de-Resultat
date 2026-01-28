<?php

namespace App\Form;

use App\Entity\Diplome;
use App\Entity\Filiere;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class DiplomeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('intitule', TextType::class, [
                'label' => 'Intitulé du diplôme',
                'attr' => ['placeholder' => 'Ex: BTS SIO']
            ])

            // On ajoute l'accent sur Filière
            ->add('filiere', EntityType::class, [
                'class' => Filiere::class,
                'label' => 'Filière',
                'choice_label' => function (Filiere $filiere) {
                    return $filiere->getId() . ' - ' . $filiere->getNom();
                },
                'placeholder' => 'Choisir une filière...',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Diplome::class,
        ]);
    }
}
