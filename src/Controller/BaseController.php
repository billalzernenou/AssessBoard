<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use App\Entity\Back\user;
use App\Entity\Front\questionnaire;
use App\Entity\Front\etablissements;
use App\Entity\Front\composantes;
use App\Entity\Front\UE;
use App\Entity\Front\sessions;
use App\Entity\Front\questionType;
use App\Entity\Front\answers;
use App\Form\QuestionnaireType;

class BaseController extends AbstractController
{
    /**
     * @Route("/", name="base")
     */
    public function index()
    {
        $res;
        $usr = $this->getUser();
        if (!$usr) {
            $res = $this->about();
        } else {
            $res = $this->dashboard();
           
        }
        return $res;
    }

    /**
     * @Route("/about", name="about")
     */
    public function about()
    {
        return $this->render('front/about/about.html.twig', [
            'text' => [
                'about_title' => 'Vous êtes sur l\'application AssessBoard',
                'text_about' => 
                'But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born 
                and I will give you a complete account of the system, and expound the actual teachings of the great explorer 
                of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, 
                because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences
                that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself,
                because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure.
                To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain 
                some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure 
                that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?',
            ],

            'controller_name' => 'BaseController',
        ]);
    }

     /**
     * @Route("/questionnaire/{id}", name="questionnaire")
     */
    public function questionnaire(Request $request, EntityManagerInterface $em, ObjectManager $manager, string $id)
    {
        $session = $em->getRepository(sessions::class)->find($id);
        if (null === $session) {
            return $this->redirectToRoute('about');
        }

        if (($session->getIsDone()) == 1){
            $message = "Vous avez déjà répondu au questionnaire !";

            return $this->render('front/confirmation.html.twig', [
                'message' => $message
            ]);
        }else{
            $questionnaire = $session->getQuestionnaire();
            $composant = $questionnaire->getComposant();
            $ues = $questionnaire->getUES();

            $questions = $em->getRepository(questionType::class)->findAll();
            $questionsContenu = $em->getRepository(questionType::class)->findBy(
                ['type' => 'Contenu']
            );
            $questionsDeroulement = $em->getRepository(questionType::class)->findBy(
                ['type' => 'Contenu']
            );
            $questionsTD_TP_Projet = $em->getRepository(questionType::class)->findBy(
                ['type' => 'TD_TP_Projet']
            );
            $questionsPresentation = $em->getRepository(questionType::class)->findBy(
                ['type' => 'Presentation']
            );

            if($request->isMethod('POST')){
                    $ues = $request->get('ue');
                    foreach($ues as $ue) {
                        $questions = $request->get("questionUE".strval($ue));
                        foreach($questions as $question) {
                            $answers = $request->get("ue".$ue."_question".$question);
                            $answer = new answers();
                            $answer->setUE($em->getRepository(UE::class)->find($ue));
                            $answer->setQuestionType($em->getRepository(questionType::class)->find($question));
                            $answer->setMark($answers);
                            $answer->setSessions($session);
                            $manager->persist($answer);
                        }
                    }
                    $session->setIsDone(1);
                    $manager->persist($session);
                    $manager->flush();

                    $message = "Merci pour votre participation !";

                    return $this->render('front/confirmation.html.twig', [
                        'message' => $message
                    ]);
            }else{
                return $this->render('front/questionnaire.html.twig', [
                'session' => $session, 'questionnaire' => $questionnaire, 'composant' => $composant, 'ues' => $ues, 'questionsContenu' => $questionsContenu, 'questionsDeroulement' => $questionsDeroulement, 'questionsTD_TP_Projet' => $questionsTD_TP_Projet, 'questionsPresentation' => $questionsPresentation, 'id' => $id
                ]);
            }
        }
        
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

        $QuestionnaireRepository = $this->getDoctrine()->getRepository(questionnaire::class);
        //$EtablissementsRepository = $this->getDoctrine()->getRepository(etablissements::class);
        //$ComposentRepository = $this->getDoctrine()->getRepository(composantes::class);

        $ques = $QuestionnaireRepository->findAll();
        //$etab = $EtablissementsRepository->findAll();
        //$comp = $ComposentRepository->findAll();

        return $this->render('back/admin/dashboard.html.twig', ['
        controller_name' => 'BaseController',
        'QuestionnaireList' => $ques,
        //'EtablissementsList' => $etab,
        //'ComposentList' => $comps
        ]);
    }

    /**
     * @Route("/create-survey", name="create-survey")
     */
    public function createSurvey(Request $request, ObjectManager $manager, \Swift_Mailer $mailer)
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

                $this->sendEmail($manager, $questionnaire, $mailer);

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

    public function sendEmail(ObjectManager $manager, questionnaire $questionnaire, \Swift_Mailer $mailer)
    {
        $emails = $this->readSpreadsheet();

        // Send a mail for each email
        foreach($emails as $email){

            //Generate a random string.
            $token = openssl_random_pseudo_bytes(16);
            //Convert the binary data into hexadecimal representation.
            $token = bin2hex($token);

            $formation = $questionnaire->getComposant()->getName();
            $formationID = $formation->getId();
            $etablissement = $formation->getEtablisseent()->getName();

            $message = (new \Swift_Message('Questionnaire de satisfaction'))
                ->setFrom('assessboard.sippe@gmail.com')
                ->setTo($email)
                ->setBody(
                    $this->renderView(
                        'mail/mailQuestionnaire.html.twig', 
                        [
                            'token' => $token,
                            'formation' => $formation,
                            'etablissement' => $etablissement
                        ]
                    )
                )
            ;
            $mailer->send($message);

            $session = new sessions();
            $session->setId($token);
            $session->setEmail($email);
            $session->setQuestionnaire($questionnaire);
            $manager->persist($session);
            $manager->flush();
        }
    }

}
