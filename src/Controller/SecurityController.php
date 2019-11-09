<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Doctrine\DBAL\Driver\Connection;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/inscription", name="security_registration")
     */
    public function registration(ObjectManager $manager,UserPasswordEncoderInterface $encoder, Request $request,\Swift_Mailer $mailer)
    {
        $user = new User();


        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {

            $hash = $encoder->encodePassword($user,$user->getPassword());
            $user->setPassword($hash);

            $manager->persist($user);
            $manager->flush();

            // Envoyer mail de confirmation
            $this->envoyermail($user->getEmail(),$user, $mailer);

            return $this->redirectToRoute('security_wait_confirmation');
        }

        return $this->render('security/registration.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/attente-confirmation", name="security_wait_confirmation")
     */
    public function attenteconfirmation(Request $request){

        return $this->render('security/attenteconfirmation.html.twig');

    }

    /**
     * @Route("/connexion", name="security_login")
     */
    public function login(ObjectManager $manager,UserPasswordEncoderInterface $encoder, Request $request)
    {
        return $this->render('security/login.html.twig');
    }

     /**
     * @Route("/logout", name="security_logout")
     */
    public function logout(ObjectManager $manager,UserPasswordEncoderInterface $encoder, Request $request)
    {

    }




    /**
     * @Route("/confirmer-particuler", name="security_confirm_particulier")
     */
    public function confirmparticulier(Request $request){

        return $this->render('security/confirmparticulier.html.twig');

    }

    /**
     * @Route("/confirmer-professionel", name="security_confirm_professionel")
     */
    public function confirmprofessionnel(Request $request){

        return $this->render('security/confirmprofessionnel.html.twig');

    }


    /**
     * @Route("/confirmer-entreprise", name="security_confirm_entreprise")
     */
    public function confirmentreprise(Request $request){

        return $this->render('security/confirmentreprise.html.twig');

    }


     /**
     * @Route("/confirmation/{token}", name="security_confirmation")
     */
    public function confirm(Request $request,Connection $connection,ObjectManager $manager,$token){

        //Retrouver le token
        $repository = $this->getDoctrine()->getRepository(User::class);
        $utilisateur = $repository->findOneBy(['confirmation' => $token]);


        $typeuser = $utilisateur->getTypeclient();
        

        switch($typeuser){

            case 'Particulier': 

            return $this->redirectToRoute('security_confirm_particulier');
            
            break;

            case 'Professionel': 

            return $this->redirectToRoute('security_confirm_professionel');
            
            break;


            case 'Entreprise': 

            return $this->redirectToRoute('security_confirm_entreprise');
            
            break;



        }
    }





    public function envoyermail($email,$user,\Swift_Mailer $mailer){

        // Envoyer mail de confirmation
        $lien =  'http://127.0.0.1:8000/confirmation/'.$user->getConfirmation();

        $message = (new \Swift_Message('Confirmation inscription'))
        ->setFrom(['noreply@yesdriveme.com'=>'Yesdriveme'])
        ->setTo($email)
        ->setBody(
            $this->renderView(
                'security/confirmregistration.html.twig',
                array('lien' => $lien,
                        'user' => $user)
            ),
            'text/html'
        )
    ;
   
    $mailer->send($message);


        return;
    }
}
