<?php

namespace App\Controller;

use App\Entity\Assignquestiontoexam;
use App\Entity\Questions;
use App\Entity\Exams;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class QuestionsController extends AbstractController
{

/**
 * @Route("/questions/show/{examid}", name="question_show")
 */
    public function show($examid)
    {
        $examDesc='';
        $uid = $this->get('security.token_storage')->getToken()->getUser()->getId();
        if ($examid > 0) {
            $repository1 = $this->getDoctrine()->getRepository(Exams::class);
            $exam = $repository1->find($examid);
            $examDesc=$exam->getDescription();

        }
        $repository = $this->getDoctrine()->getRepository(Questions::class);
        $questions = $repository->GetAllQuestions($uid, $examid);

        return $this->render(
            'questions/index.html.twig',
            array('questionstwig' => $questions, 'repans' => $repository, 'examidP' => $examid, 'examDsc'=>$examDesc)
        );
    }

    }

    /**
     * @Route("/questions/new/{examid}", name="question_new"))
     */
    function new (Request $request, $examid) {
        // creates a task and gives it some dummy data for this example
        $question = new Questions();
        $form = $this->createFormBuilder($question)
            ->add('qdescription', TextType::class, array('label' => ' '))
            ->add('qcategory', ChoiceType::class, array(
                'label' => ' ',
                'choices' => array(
                    'Programming' => 1,
                    'Math' => 2,
                    'Finish Languge' => 3,
                ),
            ))
            ->add('qdifficultylevel', ChoiceType::class, array(
                'label' => 'Difficulty',
                'choices' => array(
                    'Easy' => 0,
                    'Medium' => 1,
                    'Hard' => 2,
                ),
            ))
            ->add('cancel', SubmitType::class, array('label' => 'Cancel',
                'attr' => array('formnovalidate' => 'formnovalidate'),
            ))

            ->add('save', SubmitType::class, array('label' => 'Create Question'))
            ->getForm();

        $form->handleRequest($request);
        if ($form->getClickedButton() && 'cancel' === $form->getClickedButton()->getName()) {
            return $this->redirectToRoute('question_show', array('examid' => $examid));
        }

        if ($form->isSubmitted()) {
            // $userId=$this->get('security.token_storage')->getToken()->getUser()->getId();
            $question = $form->getData();
            $question->setUserid($this->get('security.token_storage')->getToken()->getUser()->getId());
            $question->setCanedit(1);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($question);
            $entityManager->flush();
            if ($examid > 0) {
                $assign = new Assignquestiontoexam();
                $qid = $question->getId();
                $assign->setQuestionid($qid);
                $assign->setExamid($examid);
                $entityManager1 = $this->getDoctrine()->getManager();
                $entityManager1->persist($assign);
                $entityManager1->flush();
                $question->setCanedit(0);
                $entityManager->persist($question);
                $entityManager->flush();
            }
            return $this->redirectToRoute('question_show', array('examid' => $examid));
        }

        return $this->render('questions/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    /**
     * @Route("/question/edit/{questionid}/{examid}", name="question_edit"))
     */
    public function EditQuestion(Request $request, $questionid, $examid)
    {
        $repository = $this->getDoctrine()->getRepository(Questions::class);
        $question = $repository->find($questionid);
        $form = $this->createFormBuilder($question)
            ->add('qdescription', TextType::class, array('label' => ' ', 'data' => $question->getQdescription()))
            ->add('qcategory', ChoiceType::class, array(
                'label' => ' ',
                'choices' => array(
                    'Programming' => 1,
                    'Math' => 2,
                    'Finish Languge' => 3,
                ),
                'preferred_choices' => array($question->getQcategory()),
            ))
            ->add('qdifficultylevel', ChoiceType::class, array(
                'label' => 'Difficulty',
                'choices' => array(
                    'Easy' => 0,
                    'Medium' => 1,
                    'Hard' => 2,
                ),
                'preferred_choices' => array($question->getQdifficultylevel()),
            ))
            ->add('cancel', SubmitType::class, array('label' => 'Cancel',
                'attr' => array('formnovalidate' => 'formnovalidate'),
            ))
            ->add('save', SubmitType::class, array('label' => 'Edit Question'))
            ->getForm();
        $form->handleRequest($request);
        if ($form->getClickedButton() && 'cancel' === $form->getClickedButton()->getName()) {
            return $this->redirectToRoute('question_show', array('examid' => $examid));
        }
        if ($form->isSubmitted()) {
            $question = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($question);
            $entityManager->flush();
            return $this->redirectToRoute('question_show', array('examid' => $examid));
        }
        return $this->render('questions/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/question/delete/{questionid}/{examid}", name="question_delete"))
     */
    public function DelQuestion(Request $request, $questionid, $examid)
    {
        $repository = $this->getDoctrine()->getRepository(Questions::class);
        $question = $repository->find($questionid);
        $form = $this->createFormBuilder($question)
            ->add('qdescription', TextType::class, array('label' => ' ', 'data' => $question->getQdescription()))
            ->add('qcategory', ChoiceType::class, array(
                'label' => ' ',
                'choices' => array(
                    'Programming' => 1,
                    'Math' => 2,
                    'Finish Languge' => 3,
                ),
                'preferred_choices' => array($question->getQcategory()),
            ))
            ->add('qdifficultylevel', ChoiceType::class, array(
                'label' => 'Difficulty',
                'choices' => array(
                    'Easy' => 0,
                    'Medium' => 1,
                    'Hard' => 2,
                ),
                'preferred_choices' => array($question->getQdifficultylevel()),
            ))
            ->add('cancel', SubmitType::class, array('label' => 'Cancel',
                'attr' => array('formnovalidate' => 'formnovalidate'),
            ))
            ->add('save', SubmitType::class, array('label' => 'Delete Question'))
            ->getForm();
        $form->handleRequest($request);
        if ($form->getClickedButton() && 'cancel' === $form->getClickedButton()->getName()) {
            return $this->redirectToRoute('question_show', array('examid' => $examid));
        }
        if ($form->isSubmitted()) {
            $exam = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($exam);
            $entityManager->flush();
            return $this->redirectToRoute('question_show', array('examid' => $examid));
        }
        return $this->render('questions/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

}
