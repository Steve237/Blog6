<?php


namespace App\Controller;


use App\Entity\Users;
use App\Form\InscriptionType;
use App\Repository\UsersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminSecuController extends AbstractController
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

}
