<?php

namespace App\Controller;

use App\Entity\Assignexamtostudents;
use App\Entity\Exams;
use App\Form\AssignCheck;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AssignexamtostudentsController extends AbstractController
{

    /**
     * @Route("/Assignexamtostudents/show/{examid}", name="assignexam_show")
     */
    public function show($examid)
    {
        $examDesc = '';
        $repository1 = $this->getDoctrine()->getRepository(Exams::class);
        $exam = $repository1->find($examid);
        $examDesc = $exam->getDescription();

        $repository = $this->getDoctrine()->getRepository(Assignexamtostudents::class);
        $assignexam = $repository->GetAllStExam($examid);

        return $this->render(
            'assignexamtostudents/index.html.twig',
            array('assingexamtwig' => $assignexam, 'examidP' => $examid, 'examDsc' => $examDesc)
        );

    }

    /**
     * @Route("/Assignexamtostudents/Assign/{examid}", name="assign_st"))
     */
    public function Assign(Request $request, $examid)
    {
        $repository = $this->getDoctrine()->getRepository(Assignexamtostudents::class);
        $stassignexam = $repository->GetAllStudent($examid);

        $newForm = $this->createForm(AssignCheck::class);
        foreach ($stassignexam as $value) {
            $chname = $value['id'];
            $newForm->add($chname, CheckboxType::class, array(
                'label' => 'Assign',
                'required' => false,
            ));
        }

        $newForm->add('save', SubmitType::class);

        $newForm->add('Cancel', SubmitType::class, array('label' => 'Cancel',
            'attr' => array('formnovalidate' => 'formnovalidate'),
        ));

        $newForm->handleRequest($request);
        if ($newForm->getClickedButton() && 'Cancel' === $newForm->getClickedButton()->getName()) {
            return $this->redirectToRoute('assignexam_show', array('examid' => $examid));
        }

        if ($newForm->isSubmitted()) {
            // print $tt;
            $entityManager = $this->getDoctrine()->getManager();
            $fromdata = $newForm->getData();

            foreach ($stassignexam as $value) {
                $chname = $value['id'];
                $checkassign = $repository->findOneBy([
                    'studentid' => $chname,
                    'examid' => $examid,
                ]);

                if (($fromdata[$chname] == 1) && !(isset($checkassign))) {
                    $assing = new Assignexamtostudents();
                    $assing->setExamid($examid);
                    $assing->setStudentid($value['id']);
                    $assing->setAssigndate(new \DateTime());
                    $assing->setResult(0);
                    $assing->setShowtostudent(0);
                    $assing->setExamStatus(0);
                    $assing->setSelecteddate(new \DateTime());
                    $assing->setStartrange(new \DateTime());
                    $assing->setEndrange(new \DateTime());

                    $entityManager->persist($assing);
                    $entityManager->flush();
                }
            }

            return $this->redirectToRoute('assignexam_show', array('examid' => $examid));

        }
        return $this->render('assignexamtostudents/new.html.twig', array(
            'asgform' => $newForm->createView(), 'assingexamtwig' => $stassignexam,
        ));

    }
    /**
     * @Route("/Assignexamtostudents/delete/{assignid}", name="assign_delete"))
     */
    public function DelAssign(Request $request, $assignid)
    {
        $repository = $this->getDoctrine()->getRepository(Assignexamtostudents::class);
        $assign = $repository->find($assignid);
        $examid = $assign->getExamid();
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($assign);
        $entityManager->flush();
        return $this->redirectToRoute('assignexam_show', array('examid' => $examid));

    }

}
