<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AssignExamToStudentController extends AbstractController
{
    /**
     * @Route("/assignExam", name="test")
     */
    public function index()
    {
        return $this->render('assignExamToStudents/index.html.twig', [
            'controller_name' => 'AssignExamToStudentController',
        ]);
    }
}
