<?php


namespace App\Controller;

use App\Entity\Users;
use App\Form\ResetPassType;
use App\Form\InscriptionType;
use App\Repository\UsersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;

class AuthentificationController extends AbstractController
{
    /**
     * @Route("/inscription", name="inscription")
     */
    public function index(Request $request, EntityManagerInterface $objectManager, UserPasswordEncoderInterface $encoder, \Swift_Mailer $mailer)
    {   
        $users = new Users();
        $form = $this->createForm(InscriptionType::class, $users);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            //récupère le mot de passe entré par l'utilisateur
            $passwordCrypt = $encoder->encodePassword($users, $users->getPassword());
            // crypte le mot de passe entré
            $users->setPassword($passwordCrypt);
            $users->setVerifPass($passwordCrypt);
            
            // On génère le token d'activation
            $users->setActivationToken(md5(uniqid()));

            $objectManager->persist($users);
            $objectManager->flush();
    
            
            $message = (new \Swift_Message('activation de votre compte'))

                ->setFrom('adouessono@yahoo.fr')
                ->setTo($users->getEmail())
                ->setBody(
                    $this->renderView(
                        'email/activation.html.twig', ['token' => $users->getActivationToken()]
                    ),
                    'text/html'
                )
            ;
    
            $mailer->send($message);
            return $this->redirectToRoute('accueil');
    
        }
        return $this->render('admin_secu/inscription.html.twig', [
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/connexion", name="connexion")
     */
    public function connexion(AuthenticationUtils $util) {

        return $this->render("admin_secu/connexion.html.twig", [
            "lastUserName" => $util->getLastUsername(),
            "error" => $util->getLastAuthenticationError()
        ]);
    }

    /**
     * @Route("/deconnexion", name="deconnexion")
     */
    public function deconnexion() {
    
    }

    /**
     * @Route("/activation/{token}", name="activation")
     */
    public function activation($token, UsersRepository $userRepo, Request $request, EntityManagerInterface $objectManager) {
    
        // On vérifie si un utilisateur a ce token
        $users = $userRepo->findOneBy(['activation_token' => $token]);
    
        // Si aucun utilisateur n'existe avec ce token
        if(!$users){

            throw $this->createNotFoundException('Cet utilisateur n\'existe pas');
            
        }
        
        // On supprime le token
        $users->setActivationToken(null);
        $objectManager->persist($users);
        $objectManager->flush();

        // On envoie un message flash
        $this->addFlash('message', 'Vous avez bien activé votre compte');

        // On retourne à l'accueil
        return $this->redirectToRoute('accueil');
    }


    /**
     * @Route("/recoverypass", name="recoverypassword")
     */
    public function recoveryPass(Request $request, UsersRepository $usersRepo, \Swift_Mailer $mailer, TokenGeneratorInterface $tokenGenerator, 
    EntityManagerInterface $objectManager) {
        
        //on créé le formulaire
        $form = $this->createForm(ResetPassType::class);

        //on traite le formulaire
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            //on récupère les données
            $datas = $form->getData();

            //on recherche si un utilisateur a cet email
            $user = $usersRepo->findOneByEmail($datas['email']);

            if(!$user) {

                throw $this->createNotFoundException('Cet utilisateur n\'existe pas');
            }

            $token = $tokenGenerator->generateToken();

            try{
                $user->setResetToken($token);
                $objectManager->persist($user);
                $objectManager->flush();
        
        
        
            }catch(\Exception $e) {
            
                $this->addFlash('warning', 'Une erreur est survenue: '. $e->getMessage());
                return $this->redirectToRoute('connexion');
            }
    
            $message = (new \Swift_Message('Mot de passe oublié'))
            ->setFrom('adouessono@yahoo.fr')
            ->setTo($user->getEmail())
            ->setBody($this->renderView('email/updatepass.html.twig', ['token' => $token]), 'text/html')
            ;

            //On envoie l'email
            $mailer->send($message);
            $this->addFlash('message', 'On vous a envoyé un mail pour réinitialiser votre mot de passe');
            return $this->redirectToRoute('connexion');
            
        }
        

        return $this->render('admin_secu/recoverypass.html.twig', ['emailForm' => $form->createView()]);
    }

    /**
     * @Route("/updatepass/{token}", name="updatepass")
     */
    public function updatePass($token, Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $objectManager) {
        
        //On cherche l'utilisateur avec le token fourni
        $user = $this->getDoctrine()->getRepository(Users::class)->findOneBy(['reset_token' => $token]);

        if(!$user){
            
            $this->addFlash('danger', 'Token Inconnu');
            return $this->redirectToRoute('connexion');
        }

        if($request->isMethod('POST')){

            $user->setResetToken(null);
            $user->setPassword($passwordEncoder->encodePassword($user,  $request->request->get('password')));
            $objectManager->persist($user);
            $objectManager->flush();
            $this->addFlash('message', 'Mot de passe modifié avec succès');
            return $this->redirectToRoute('connexion');
        
        
        
        } else {
            
            return $this->render('admin_secu/newpass.html.twig', ['token' => $token]);
        }
    }
}