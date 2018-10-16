<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ExamsController extends AbstractController
{
    /**
     * @Route("/exams", name="exams")
     */
    public function index()
    {
        return $this->render('exams/index.html.twig', [
            'controller_name' => 'ExamsController',
        ]);
    }
}
