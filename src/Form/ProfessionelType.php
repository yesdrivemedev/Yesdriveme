<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfessionelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            
            ->add('nom')
            ->add('prenom')
            ->add('telephone')
            ->add('datenaissance')
            ->add('adressedomicile')
            ->add('ville')
            ->add('pays')
            ->add('descriptionclient')
            ->add('societe')
            ->add('adressesociete')
            ->add('telephonesociete')
            ->add('typesociete')
            ->add('emailsociete')
            ->add('adressefacturation')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
