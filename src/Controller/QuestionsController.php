<?php

namespace App\Controller;
use App\Entity\Questions;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;



class QuestionsController extends AbstractController
{
    /**
     * @Route("/questions", name="questions")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Questions::class);
        $questions = $repository->GetAllQuestions(11);
        //$answers = $repository->GetAllAnswers(11);
        // $questions = $this->getDoctrine()
        // ->getRepository(Questions::class)
        // ->GetAllQuestions(11);

        // $repository = $this->getDoctrine()->getRepository(Questions::class);
        // $questions = $repository->GetAllQuestions(11);

        // ....
        // return $this->render('product_list.html.twig', array('oCatRepo' => $oCatRepo));

        return $this->render(
            'questions/index.html.twig',
            array('questionstwig' => $questions, 'repans'=>$repository)
        );

       
    }
    /** 
      * @Route("/questions/new") 
   */ 
      public function new(Request $request)
    {
        // creates a task and gives it some dummy data for this example
        $question = new Questions();
        // $question->setQdescription('');
        // $question->setQcategory(0);

        

        $form = $this->createFormBuilder($question)
        
            ->add('qdescription',TextType::class,array('label' => 'Question '))
            ->add('qcategory', ChoiceType::class, array(
                'label' => 'Category',
                'choices'  => array(
                    'Programming' => 1,
                    'Math' => 2,
                    'Finish Languge' => 3
                ),
            ))

            ->add('save', SubmitType::class, array('label' => 'Create Question'))
            ->getForm();

            // $form->handleRequest($request);

            // if ($form->isSubmitted() ) {
            //     // perform some action...
        
            //     return $this->redirectToRoute('questions');
            // }

        return $this->render('questions/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
