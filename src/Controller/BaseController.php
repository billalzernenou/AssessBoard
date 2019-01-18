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
     * @Route("/create-survey", name="create-survey")
     */
    public function createSurvey()
    {
        return $this->render('back/create-survey.html.twig', [
            'controller_name' => 'BaseController',
        ]);
    }
}
