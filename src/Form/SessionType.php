<?php

namespace App\Entity;
namespace App\Form;

use App\Entity\Diplome;
use App\Entity\Session;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SessionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('annee', null, [
                'label' => 'Année de la session'
            ])
            ->add('statut', ChoiceType::class, [
                'choices'  => [
                    'Brouillon' => 'Brouillon',
                    'Validé' => 'Validé',
                    'Publié' => 'Publié',
                ],
                'label' => 'État de la session'
            ])
            ->add('tauxReussite', null, [
                'label' => 'Taux de réussite (%)',
                'required' => false,
            ])
            ->add('diplome', EntityType::class, [
                'class' => Diplome::class,
                'choice_label' => 'intitule',
                'label' => 'Diplôme associé'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Session::class,
        ]);
    }
}
