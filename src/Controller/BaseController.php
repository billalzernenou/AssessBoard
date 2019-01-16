<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BaseController extends AbstractController
{
    /**
     * @Route("/base", name="base")
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

            'controller_name' => 'BaseController',
        ]);
    }
}
