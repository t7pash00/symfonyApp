<?php

namespace App\Controller;
use App\Entity\Answers;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class AnswersController extends AbstractController
{

    /**
     * @Route("/answer/new/{questionid}/{examid}", name="answer_new"))
     */
    function new (Request $request, $questionid, $examid) {
        // creates a task and gives it some dummy data for this example
        $answer = new Answers();
        $form = $this->createFormBuilder($answer)
            ->add('ansdescription', TextType::class, array('label' => ' '))
            ->add('iscorrect', ChoiceType::class, array(
                'label' => ' ',
                'choices' => array(
                    'Wrong' => 0,
                    'Correct' => 1,

                ),
            ))
            ->add('cancel', SubmitType::class, array('label' => 'Cancel',
                'attr' => array('formnovalidate' => 'formnovalidate'),
            ))
            ->add('save', SubmitType::class, array('label' => 'Create Answer'))
            ->getForm();

        $form->handleRequest($request);
        if ($form->getClickedButton() && 'cancel' === $form->getClickedButton()->getName()) {
            return $this->redirectToRoute('question_show', array('examid' => $examid));
        }
        if ($form->isSubmitted()) {
            $answer = $form->getData();
            $answer->setQuestionid($questionid);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($answer);
            $entityManager->flush();

            return $this->redirectToRoute('question_show', array('examid' => $examid));
        }

        return $this->render('answers/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

/**
 * @Route("/answer/edit/{answerid}/{examid}", name="answer_edit"))
 */
    public function EditAnswer(Request $request, $answerid, $examid)
    {
        $repository = $this->getDoctrine()->getRepository(Answers::class);
        $answer = $repository->find($answerid);
        $form = $this->createFormBuilder($answer)
            ->add('ansdescription', TextType::class, array('label' => ' ', 'data' => $answer->getAnsdescription()))
            ->add('iscorrect', ChoiceType::class, array(
                'label' => ' ',
                'choices' => array(
                    'Wrong' => 0,
                    'Correct' => 1,
                ),
                'preferred_choices' => array($answer->getIscorrect()),
            ))
            ->add('cancel', SubmitType::class, array('label' => 'Cancel',
                'attr' => array('formnovalidate' => 'formnovalidate'),
            ))
            ->add('save', SubmitType::class, array('label' => 'Edit Answer'))
            ->getForm();

        $form->handleRequest($request);
        if ($form->getClickedButton() && 'cancel' === $form->getClickedButton()->getName()) {
            return $this->redirectToRoute('question_show', array('examid' => $examid));
        }
        if ($form->isSubmitted()) {
            $answer = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($answer);
            $entityManager->flush();

            return $this->redirectToRoute('question_show', array('examid' => $examid));
        }

        return $this->render('answers/new.html.twig', array(
            'form' => $form->createView(),
        ));

    }

    /**
     * @Route("/answer/delete/{answerid}/{examid}", name="answer_delete"))
     */
    public function DelAnswer(Request $request, $answerid, $examid)
    {
        $repository = $this->getDoctrine()->getRepository(Answers::class);
        $answer = $repository->find($answerid);
        $form = $this->createFormBuilder($answer)
            ->add('ansdescription', TextType::class, array('label' => ' ', 'data' => $answer->getAnsdescription()))
            ->add('iscorrect', ChoiceType::class, array(
                'label' => ' ',
                'choices' => array(
                    'Wrong' => 0,
                    'Correct' => 1,
                ),
                'preferred_choices' => array($answer->getIscorrect()),
            ))
            ->add('cancel', SubmitType::class, array('label' => 'Cancel',
                'attr' => array('formnovalidate' => 'formnovalidate'),
            ))
            ->add('save', SubmitType::class, array('label' => 'Delete Answer'))
            ->getForm();

        $form->handleRequest($request);
        if ($form->getClickedButton() && 'cancel' === $form->getClickedButton()->getName()) {
            return $this->redirectToRoute('question_show', array('examid' => $examid));
        }
        if ($form->isSubmitted()) {
            $answer = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($answer);
            $entityManager->flush();
            return $this->redirectToRoute('question_show', array('examid' => $examid));
        }

        return $this->render('answers/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

}
