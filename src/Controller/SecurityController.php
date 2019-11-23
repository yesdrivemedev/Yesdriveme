<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\EntrepriseType;
use App\Form\ParticulierType;
use App\Form\ProfessionelType;
use App\Form\RegistrationType;
use App\Entity\Notificationmail;
use App\Form\ChangermotdepasseType;
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
            $Emailtype = 'Inscription_initiale';
            $this->envoyermail($user->getEmail(),$user,$Emailtype, $mailer);

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
     * @Route("/changer-mot-de-passe/{token}", name="security_confirm_pwd")
     */
    public function changerpwd(ObjectManager $manager,UserPasswordEncoderInterface $encoder, Request $request,\Swift_Mailer $mailer,$token)
    {


        $repository = $this->getDoctrine()->getRepository(User::class);
        $user = $repository->findOneBy(['changerpwd' => $token]);


        $form = $this->createForm(ChangermotdepasseType::class, $user);

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {

            $hash = $encoder->encodePassword($user,$user->getPassword());
            $user->setPassword($hash);
            $user->setChangerpwd("");

            $manager->persist($user);
            $manager->flush();

           

            return $this->redirectToRoute('security_login');
        }

        return $this->render('security/changermotdepasse.html.twig',[
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/mot-de-passe-oublie", name="security_forget-pwd")
     */
    public function oubliemotdepasse(ObjectManager $manager,UserPasswordEncoderInterface $encoder, Request $request,\Swift_Mailer $mailer)
    {

        if($_SERVER['REQUEST_METHOD'] == 'POST') {


            $repository = $this->getDoctrine()->getRepository(User::class);
            $user = $repository->findOneBy(
                ['email' => $_POST['email'], 
                'isActive' => true]
            );


           

            // Envoyer mail de confirmation
            $Emailtype = 'Mot_de_passe_oublie';

           $token =  $this->genererToken();

            $user->setChangerpwd($token);
            $manager->persist($user);
            $manager->flush();


            $this->envoyermail($user->getEmail(),$user,$Emailtype, $mailer);

            //Enregistrer la notification en base
            $notification = new Notificationmail();
            $notification->setTypemail($Emailtype);
            $notification->setContenu($Emailtype);
            $notification->setEmail($user->getEmail());
            $manager->persist($notification);
            $manager->flush();
           
            return $this->render('security/message.html.twig',array('message'=> 'Un mail vous a été envoyé. Merci de vérifier','titre'=>'Mot de passe oublié'));

        }

        return $this->render('security/oubliemotdepasse.html.twig');
    }

     /**
     * @Route("/logout", name="security_logout")
     */
    public function logout(ObjectManager $manager,UserPasswordEncoderInterface $encoder, Request $request)
    {

    }




    /**
     * @Route("/confirmer-particuler/{token}", name="security_confirm_particulier")
     */
    public function confirmparticulier(Request $request,ObjectManager $manager,Connection $connection,\Swift_Mailer $mailer, $token){


        
        //Retrouver le token
        $repository = $this->getDoctrine()->getRepository(User::class);
        $user = $repository->findOneBy(['confirmation' => $token]);
        $form = $this->createForm(ParticulierType::class,$user);

        $form->handleRequest($request);

        if ($form->isSubmitted()  &&  $form->isValid()){

             //Activation du client
             $connection->exec("update user set is_active = 1 where id = ".$user->getId());
             $user->setConfirmation(date("Y-m-d H:i:s"));
             $manager->persist($user);
             $manager->flush($user);

            // Envoyer mail de confirmation
            $Emailtype = 'Inscription_confirmation';
            $this->envoyermail($user->getEmail(),$user,$Emailtype, $mailer);
            

            //Enregistrer la notification en base
            $notification = new Notificationmail();
            $notification->setTypemail($Emailtype);
            $notification->setContenu($Emailtype);
            $notification->setEmail($user->getEmail());
            $manager->persist($notification);
            $manager->flush();

            return $this->redirectToRoute('security_login');
        }

        return $this->render('security/confirmparticulier.html.twig',[
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/confirmer-professionel/{token}", name="security_confirm_professionel")
     */
    public function confirmprofessionel(Request $request,ObjectManager $manager,Connection $connection,\Swift_Mailer $mailer, $token){


        
        //Retrouver le token
        $repository = $this->getDoctrine()->getRepository(User::class);
        $user = $repository->findOneBy(['confirmation' => $token]);
        $form = $this->createForm(ProfessionelType::class,$user);

        $form->handleRequest($request);

        if ($form->isSubmitted()  &&  $form->isValid()){

             //Activation du client
             $connection->exec("update user set is_active = 1 where id = ".$user->getId());
             $user->setConfirmation(date("Y-m-d H:i:s"));
             $user->setRoles(['ROLE_PROFESSIONEL']);
             $manager->persist($user);
             $manager->flush($user);

            // Envoyer mail de confirmation
            $Emailtype = 'Inscription_confirmation_professionel';
            $this->envoyermail($user->getEmail(),$user,$Emailtype, $mailer);

            //Enregistrer la notification en base
            $notification = new Notificationmail();
            $notification->setTypemail($Emailtype);
            $notification->setContenu($Emailtype);
            $notification->setEmail($user->getEmail());
            $manager->persist($notification);
            $manager->flush();

            return $this->redirectToRoute('security_login');
        }

        return $this->render('security/confirmprofessionel.html.twig',[
            'form' => $form->createView()
        ]);

    }


    /**
     * @Route("/confirmer-entreprise/{token}", name="security_confirm_entreprise")
     */
    public function confirmentreprise(Request $request,ObjectManager $manager,Connection $connection,\Swift_Mailer $mailer, $token){


        
        //Retrouver le token
        $repository = $this->getDoctrine()->getRepository(User::class);
        $user = $repository->findOneBy(['confirmation' => $token]);
        $form = $this->createForm(EntrepriseType::class,$user);

        $form->handleRequest($request);

        if ($form->isSubmitted()  &&  $form->isValid()){

             //Activation du client
             $connection->exec("update user set is_active = 1 where id = ".$user->getId());
             $user->setConfirmation(date("Y-m-d H:i:s"));
             $user->setRoles(['ROLE_ENTREPRISE']);
             $manager->persist($user);
             $manager->flush($user);

            // Envoyer mail de confirmation
            $Emailtype = 'Inscription_confirmation_entreprise';
            $this->envoyermail($user->getEmail(),$user,$Emailtype, $mailer);

            //Enregistrer la notification en base
            $notification = new Notificationmail();
            $notification->setTypemail($Emailtype);
            $notification->setContenu($Emailtype);
            $notification->setEmail($user->getEmail());
            $manager->persist($notification);
            $manager->flush();

            return $this->redirectToRoute('security_login');
        }

        return $this->render('security/confirmentreprise.html.twig',[
            'form' => $form->createView()
        ]);

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

            return $this->redirectToRoute('security_confirm_particulier',array('token'=>$token));
            
            break;

            case 'Professionel': 

            return $this->redirectToRoute('security_confirm_professionel',array('token'=>$token));
            
            break;
            

            case 'Entreprise': 

            return $this->redirectToRoute('security_confirm_entreprise',array('token'=>$token));
            
            break;



        }
    }





    public function envoyermail($email,$user,$Emailtype, \Swift_Mailer $mailer){

        // Envoyer mail de confirmation
        $lien =  '';
        $sujet = '';
        $page = '';

        switch($Emailtype){

            case 'Inscription_initiale':
            $sujet = 'Confirmation inscription';
            $page =  'confirmregistration.html.twig';
            $lien =  'http://127.0.0.1:8000/confirmation/'.$user->getConfirmation();
            break; 

            case 'Inscription_confirmation':
            $sujet = 'Bienvenue sur Yesdriveme';
            $page =  'bienvenue.html.twig';
            $lien =  'http://127.0.0.1:8000/confirmation/'.$user->getConfirmation();
            break;
            
            case 'Inscription_confirmation_chauffeur':
            $sujet = 'Bienvenue sur Yesdriveme';
            $page =  'bienvenuechauffeur.html.twig';
            $lien =  'http://127.0.0.1:8000/confirmation/'.$user->getConfirmation();
            break;

            case 'Inscription_confirmation_professionel':
            $sujet = 'Bienvenue sur Yesdriveme';
            $page =  'bienvenueprofessionel.html.twig';
            $lien =  'http://127.0.0.1:8000/confirmation/'.$user->getConfirmation();
            break;

            case 'Inscription_confirmation_entreprise':
            $sujet = 'Bienvenue sur Yesdriveme';
            $page =  'bienvenueentrprise.html.twig';
            $lien =  'http://127.0.0.1:8000/confirmation/'.$user->getConfirmation();
            break;

            case 'Mot_de_passe_oublie': 
            $sujet = 'Changer mot de passe';
            $page =  'confirmechangerpwd.html.twig';
            $lien =  'http://127.0.0.1:8000/changer-mot-de-passe/'.$user->getChangerpwd();
            break;

        }

        $message = (new \Swift_Message($sujet))
        ->setFrom(['noreply@yesdriveme.com'=>'Yesdriveme'])
        ->setTo($email)
        ->setBody(
            $this->renderView(
                'security/'.$page,

                array('lien' => $lien,
                        'user' => $user)
            ),
            'text/html'
        )
    ;
    
    $mailer->send($message);


        return;
    }


    public function genererToken(){

            // Générer un code aléatoire de 10 caractères pour la confirmation du mail
            $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $longueur = 35;
            $longueurMax = strlen($caracteres);
            $chaineAleatoire = '';
            for ($i = 0; $i < $longueur; $i++)
            {
                $chaineAleatoire .= $caracteres[rand(0, $longueurMax - 1)];
            }

            return $chaineAleatoire.date("YmdHis_pwd");

    }
}
