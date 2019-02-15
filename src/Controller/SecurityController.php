<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Back\User;
use App\Form\RegistrationType;
use App\Form\ResetPasswordType;
use Symfony\Component\Security\Core\Encoder\BasePasswordEncoder;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Form\FormError;


class SecurityController extends AbstractController
{
  /**
   * @Route("/create-user", name="create-user")
   */
  public function registration(Request $request, ObjectManager $manager,UserPasswordEncoderInterface $encoder, \Swift_Mailer $mailer){
    $user = new User();
    $form= $this->createForm(RegistrationType::class,$user);
    $form->handleRequest($request);
      $random = openssl_random_pseudo_bytes(8);
      $random = bin2hex($random);


    if($form->issubmitted() && $form->isValid()) {
      $hash = $encoder->encodePassword($user,$random);
      $user->setPassword($hash);
      $manager->persist($user);
      $manager->flush();
      $task = $form->getData();

    $message = (new \Swift_Message('AssessBoard  Inscription'))
      ->setFrom('assessboard.sippe@gmail.com')
      ->setTo($form->get('email')->getData())
      // Or set it after like this
      ->setBody(
           $this->renderView(
              'mail/mail.html.twig',
              ['user' => $user,
              'password'=> $random]
          )
      );

      $mailer->send($message);

      return $this->redirectToRoute('security_login');
    }
      return $this->render('security/create-user.html.twig',[
          'form' => $form->createView()
      ]);
  }
    /**
     * @Route("/connexion", name="security_login")
     */
    public function login(){
        return $this->render('security/login.html.twig',[
        ]);
    }
    /**
     * @Route("/deconnexion", name="security_logout")
     */
    public function logout(){

    }



    /**
     * @Route("/edit_password", name="edit_password")
     *
     */
        public function editAction(Request $request,UserPasswordEncoderInterface $encoder)
            {

              $em = $this->getDoctrine()->getManager();
                 $user = $this->getUser();
             	$form = $this->createForm(ResetPasswordType::class, $user);

             	/*$form->handleRequest($request);
                 if ($form->isSubmitted() && $form->isValid()) {

                     //$passwordEncoder = $this->get('security.password_encoder');
                     dump($request->request);
                     die;
                     $oldPassword = $request->request->get('etiquettebundle_user')['oldPassword'];

                     // Si l'ancien mot de passe est bon
                     if ($encoder->isPasswordValid($user, $oldPassword)) {
                         $newEncodedPassword = $encoder->encodePassword($user, $user->getPlainPassword());
                         $user->setPassword($newEncodedPassword);

                         $em->persist($user);
                         $em->flush();

                         $this->addFlash('notice', 'Votre mot de passe à bien été changé !');

                         return $this->redirectToRoute('profile');
                     } else {
                         $form->addError(new FormError('Ancien mot de passe incorrect'));
                     }
                 }**/
                 if ($request->isMethod('POST')) {
                   DUMP($user);
                   die;
                 $newEncodedPassword = $encoder->encodePassword($user, $user->getPlainPassword());
                 $user->setPassword($newEncodedPassword);

                 $em->persist($user);
                 $em->flush();
 }
            return $this->render('security/edit.html.twig', array(
              'form' => $form->createView(),
            ));

}
}
