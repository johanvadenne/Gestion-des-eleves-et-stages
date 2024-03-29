<?php

namespace App\Form;

use App\Entity\Entreprise;
use App\Entity\Etudiant;
use App\Entity\StageApprentissage;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StageApprentissageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('DateDebut', null, [
                'widget' => 'single_text',
            ])
            ->add('DateFin', null, [
                'widget' => 'single_text',
            ])
            ->add('IdEtudiant', EntityType::class, [
                'class' => Etudiant::class,
                'choice_label' => function ($etudiant) {
                    return $etudiant->getNomEleve() . ' ' . $etudiant->getPrenomEtudiant();
                }
            ])
            ->add('IdEntreprise', EntityType::class, [
                'class' => Entreprise::class,
                'choice_label' => 'NomEntreprise',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => StageApprentissage::class,
        ]);
    }
}
