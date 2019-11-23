<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EntrepriseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           
            ->add('nom')
            ->add('prenom')
            ->add('telephone')
            ->add('ville')
            ->add('pays')
            ->add('descriptionclient')
            ->add('societe')
            ->add('adressesociete')
            ->add('telephonesociete')
            ->add('typesociete')
            ->add('emailsociete')
            ->add('adressefacturation')
            ->add('taillesociete')
            ->add('activitesociete')
            ->add('nombrevoiture')
            ->add('typevoiture')
            ->add('gestionnaire')
            ->add('emailgestionnaire')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
