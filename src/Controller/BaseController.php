<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use App\Entity\Front\questionnaire;
use App\Entity\Front\UE;
use App\Entity\Front\sessions;
use App\Form\QuestionnaireType;

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
    public function dashboard(EntityManagerInterface $em) {
        return $this->render('front/dashboard/dashboard.html.twig');
    }

    /**
     * @Route("/create-survey", name="create-survey")
     */
    public function createSurvey(Request $request, ObjectManager $manager)
    {
        $questionnaire = new questionnaire();
        $form= $this->createForm(QuestionnaireType::class,$questionnaire);
        $form->handleRequest($request);

        if($form->issubmitted() && $form->isValid()) {

            $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

            if(isset($_FILES['file']['name']) && in_array($_FILES['file']['type'], $file_mimes)) {

                foreach ($questionnaire->getUES() as $ue)
                {
                    $ue->setQuestionnaire($questionnaire);
                }

                $manager->persist($questionnaire);
                //$manager->flush();

                $this->sendEmail($manager, $questionnaire);

                $request->getSession()
                    ->getFlashBag()
                    ->add('success', 'Le questionnaire a été crée.')
                ;

                return $this->redirectToRoute('create-survey');

            }else{
                $request->getSession()
                    ->getFlashBag()
                    ->add('danger', 'Erreur')
                ;
                return $this->redirectToRoute('create-survey');
            }
        }
        return $this->render('back/admin/create-survey.html.twig', [
          'form' => $form->createView()
        ]);
    }

    public function readSpreadsheet()
    {

        $arr_file = explode('.', $_FILES['file']['name']);
        $extension = end($arr_file);

        // Read the spreadsheet
        if('csv' == $extension) {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
        } else {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }

        $spreadsheet = $reader->load($_FILES['file']['tmp_name']);

        $sheetData = $spreadsheet->getActiveSheet()->toArray();

        // Retrive emails in an array
        $emails = [];
        foreach($sheetData as $row => $innerArray){
            foreach($innerArray as $innerRow => $value){
                if(\strpos($value, '@') !== false){
                    array_push($emails,$value);
                }
            }
        }
        return $emails;
    }

    public function sendEmail(ObjectManager $manager, questionnaire $questionnaire)
    {
        $emails = $this->readSpreadsheet();

        // Send a mail for each email
        foreach($emails as $email){

            //Generate a random string.
            $token = openssl_random_pseudo_bytes(16);
            //Convert the binary data into hexadecimal representation.
            $token = bin2hex($token);

            $session = new sessions();
            $session->setId($token);
            $session->setEmail($email);
            $session->setQuestionnaire($questionnaire);
            $manager->persist($session);
            $manager->flush();
        }
    }

}
