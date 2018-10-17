<?php

namespace App\Controller;
use App\Entity\Exams;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class ExamsController extends AbstractController
{

  /**
   * @Route("/exams/show", name="exams_show")
   */
  public function show()
  {
      $uid = $this->get('security.token_storage')->getToken()->getUser()->getId();
      $repository = $this->getDoctrine()->getRepository(Exams::class);
      $exams = $repository->GetAllExams($uid);


      // if (!$exams) {
      //     throw $this->createNotFoundException(
      //         'No Exam found for user id '.$uid
      //     );
      // }

      return $this->render(
          'exams/index.html.twig',
          array('examstwig' => $exams)
      );

  }


  /**
    * @Route("/exam/new", name="exam_new"))
 */
    public function new(Request $request)
  {
      // creates a task and gives it some dummy data for this example
      $exam = new Exams();
      $form = $this->createFormBuilder($exam)
          ->add('description',TextType::class,array('label' => ' '))
          ->add('category', ChoiceType::class, array(
              'label' => ' ',
              'choices'  => array(
                  'Programming' => 1,
                  'Math' => 2,
                  'Finish Languge' => 3
              ),
          ))
          ->add('cancel', SubmitType::class, array('label' => 'Cancel',
              'attr' => array('formnovalidate'=>'formnovalidate'),
          ))



          ->add('save', SubmitType::class, array('label' => 'Create Exam'))
          ->getForm();

          $form->handleRequest($request);
          if ($form->getClickedButton() && 'cancel' === $form->getClickedButton()->getName()) {
                return $this->redirectToRoute('exams_show');
          }
          if ($form->isSubmitted()) {
              $exam = $form->getData();
              $exam->setTeacherid($this->get('security.token_storage')->getToken()->getUser()->getId());
              $exam->setCreateddate(new \DateTime());
              $exam->setCanchange(1);

              $entityManager = $this->getDoctrine()->getManager();
              $entityManager->persist($exam);
              $entityManager->flush();

              return $this->redirectToRoute('exams_show');
          }

      return $this->render('exams/new.html.twig', array(
          'form' => $form->createView(),
      ));
  }


  /**
    * @Route("/exam/edit/{examid}", name="exam_edit"))
 */
public function EditExam(Request $request, $examid)
    {
    $repository = $this->getDoctrine()->getRepository(Exams::class);

    $exam = $repository->find($examid);


      $form = $this->createFormBuilder($exam)
          ->add('description',TextType::class,array('label' => ' ',  'data' => $exam->getDescription(),))
          ->add('category', ChoiceType::class, array(
              'label' => ' ',
              'choices'  => array(
                  'Programming' => 1,
                  'Math' => 2,
                  'Finish Languge' => 3
              ),
              'preferred_choices' => array($exam->getCategory()),

          ))
          ->add('cancel', SubmitType::class, array('label' => 'Cancel',
              'attr' => array('formnovalidate'=>'formnovalidate'),
          ))



          ->add('save', SubmitType::class, array('label' => 'Edit Exam'))
          ->getForm();

          $form->handleRequest($request);
          if ($form->getClickedButton() && 'cancel' === $form->getClickedButton()->getName()) {
                return $this->redirectToRoute('exams_show');
          }
          if ($form->isSubmitted()) {
              $exam = $form->getData();
              // $exam->setTeacherid($this->get('security.token_storage')->getToken()->getUser()->getId());
              // $exam->setCreateddate(new \DateTime());
              // $exam->setCanchange(1);

              $entityManager = $this->getDoctrine()->getManager();
              $entityManager->persist($exam);
              $entityManager->flush();

              return $this->redirectToRoute('exams_show');
          }

      return $this->render('exams/new.html.twig', array(
          'form' => $form->createView(),
      ));
  }

  /**
    * @Route("/exam/delete/{examid}", name="exam_delete"))
  */
  public function DelExam(Request $request, $examid)
    {
    $repository = $this->getDoctrine()->getRepository(Exams::class);

    $exam = $repository->find($examid);


      $form = $this->createFormBuilder($exam)
          ->add('description',TextType::class,array('label' => ' ',  'data' => $exam->getDescription(),))
          ->add('category', ChoiceType::class, array(
              'label' => ' ',
              'choices'  => array(
                  'Programming' => 1,
                  'Math' => 2,
                  'Finish Languge' => 3
              ),
              'preferred_choices' => array($exam->getCategory()),

          ))
          ->add('cancel', SubmitType::class, array('label' => 'Cancel',
              'attr' => array('formnovalidate'=>'formnovalidate'),
          ))



          ->add('save', SubmitType::class, array('label' => 'Delete Exam'))
          ->getForm();

          $form->handleRequest($request);
          if ($form->getClickedButton() && 'cancel' === $form->getClickedButton()->getName()) {
                return $this->redirectToRoute('exams_show');
          }
          if ($form->isSubmitted()) {
              $exam = $form->getData();
              

              $entityManager = $this->getDoctrine()->getManager();


              $entityManager->remove($exam);


              $entityManager->flush();

              return $this->redirectToRoute('exams_show');
          }

      return $this->render('exams/new.html.twig', array(
          'form' => $form->createView(),
      ));
  }


}
