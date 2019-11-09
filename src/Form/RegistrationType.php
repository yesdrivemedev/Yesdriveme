<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('password', PasswordType::class)
            ->add('email', EmailType::class)
            ->add('confirm_password', PasswordType::class)
            ->add('typeclient', ChoiceType::class, [
                'choices'  => [
                    'Particulier' => 'Particulier',
                    'Professionel' => 'Professionel',
                    'Entreprise' => 'Entreprise',
                ],
            ])
/*            ->add('nom')
            ->add('prenom')

            
            ->add('telephone')
            ->add('adressedomicile')
            ->add('ville')
            ->add('pays')
            ->add('photo')
            ->add('descriptionclient')
            ->add('offre')
            ->add('admin')
            ->add('exterieur')
            ->add('solde')
            ->add('noteclient')
            ->add('notedriver')
            ->add('categorieclient')
            ->add('categoriedriver')
            ->add('dateinsertion')
            ->add('dateinsertiondriver')
            ->add('datenaissance')
            ->add('typeclient')
            ->add('societe')
            ->add('adressesociete')
            ->add('telephonesociete')
            ->add('typesociete')
            ->add('registrecommerce')
            ->add('emailsociete')
            ->add('latitude')
            ->add('longitude')
            ->add('isdriver')
            ->add('siren')
            ->add('datepermis')
            ->add('typepermis')
            ->add('disponible')
            ->add('confirmationdriver')
            ->add('comptestripe')
            ->add('conduite')
            ->add('ponctualite')
            ->add('attention')
            ->add('personneabord')
            ->add('gradechauffeur')
            ->add('adressefacturation')
            ->add('taillesociete')
            ->add('activitesociete')
            ->add('nombrevoiture')
            ->add('typevoiture')
            ->add('modele')
            ->add('marque')
            ->add('immatriculation')
            ->add('gestionnaire')
            ->add('emailgestionnaire') */
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
