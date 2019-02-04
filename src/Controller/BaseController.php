<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BaseController extends AbstractController
{
    /**
     * @Route("/", name="base")
     */
    public function index()
    {
        return $this->render('base/index.html.twig', [
            'controller_name' => 'BaseController',
        ]);
    }

   /**
     * @Route("/sign-in", name="sign-in")
     */
    public function signIn()
    {
        return $this->render('front/sign-in.html.twig', ['
        controller_name' => 'BaseController',
        ]);
    }
    /**
     * @Route("/about", name="about")
     */
    public function about()
    {
        return $this->render('front/about/about.html.twig', [
            'text' => [
                'about_title' => 'Vous êtes sur l\'application AssessBoard',
                'text_about' => 'Notre Application permet de donner des notes au unités d\'enseignement d\'une formation donnée',
            ],

            'controller_name' => 'BaseController',
        ]);
    }

     /**
     * @Route("/questionnaire", name="questionnaire")
     */
    public function questionnaire()
    {
        return $this->render('front/questionnaire.html.twig', [
            'controller_name' => 'BaseController',
          ]);
    }
     /**
     * @Route("/statistique", name="statistique")
     */
    public function statistique()
    {
        return $this->render('front/statistique.html.twig', [
            'controller_name' => 'BaseController',
          ]);
    }

    /**
     * @Route("/settings", name="settings")
     */
    public function settings() {
        return $this->render('back/admin/settings.html.twig', [

            'controller_name' => 'BaseController',
        ]);
    }
  
  /**
     * @Route("/create-user", name="create-user")
     */
    public function createUser()
    {
        return $this->render('back/admin/create-user.html.twig', ['
        controller_name' => 'BaseController',
        ]);
    }


    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function dashboard() {
        return $this->render('front/dashboard/dashboard.html.twig');
    }

    /**
     * @Route("/create-survey", name="create-survey")
     */
    public function createSurvey()
    {
        return $this->render('back/admin/create-survey.html.twig', ['
        controller_name' => 'BaseController',
        ]);
    }

}
