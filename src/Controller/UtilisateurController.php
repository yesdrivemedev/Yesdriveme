<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\EntrepriseType;
use App\Form\ParticulierType;
use App\Form\ProfessionelType;
use Doctrine\DBAL\Driver\Connection;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UtilisateurController extends AbstractController
{
    /**
     * @Route("/moncompte", name="utilisateur-home")
     */
    public function index(Request $request,Connection $connection,ObjectManager $manager, \Swift_Mailer $mailer)
    {

        //Retrouver l'utilisateur
        $repository = $this->getDoctrine()->getRepository(User::class);
        $user = $repository->find($this->getUser()->getId());

        // CREATAION DU FORMULAIRE ENTREPRISE
        $form = $this->createForm(EntrepriseType::class,$user);
        $form->handleRequest($request);

        if ($form->isSubmitted()  &&  $form->isValid()){

             //Modifier les informations du client
             $manager->persist($user);
             $manager->flush($user);

        }
      // FIN FORMULAIRE ENTREPRISE 


         // CREATAION DU FORMULAIRE ENTREPRISE
         $form_professionel = $this->createForm(ProfessionelType::class,$user);
         $form_professionel->handleRequest($request);
 
         if ($form_professionel->isSubmitted()  &&  $form_professionel->isValid()){
 
              //Modifier les informations du client
              $manager->persist($user);
              $manager->flush($user);
 
         }
       // FIN FORMULAIRE ENTREPRISE 


      //FORMULAIRE CLIENT PARTICULIER
      $form_particulier = $this->createForm(ParticulierType::class,$user);
        $form_particulier->handleRequest($request);

        if ($form_particulier->isSubmitted()  &&  $form_particulier->isValid()){

             //Modifier les informations du client
             $manager->persist($user);
             $manager->flush($user);

        }

      // FIN FORMULAIRE PARTICULIER 

        return $this->render('utilisateur/moncompte.html.twig',
        [
            'form' => $form->createView(), // FORMULAIRE ENTREPRISE
            'form_particulier' => $form_particulier->createView(), // FORMULAIRE PARTICULIER
            'form_professionel' => $form_professionel->createView(), // FORMULAIRE PROFESSIONEL
        ]);
    }

        /**
     * @Route("/moncompte/modifier-photo-de-profile", name="utilisateur_modifier_photo")
     */
    public function modifierphoto(Request $request){

      return $this->render('utilisateur/modifierphoto.html.twig');

  }
}
