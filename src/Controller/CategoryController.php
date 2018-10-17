<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category", name="category")
     */
    public function index()
    {
        $category = $this->getDoctrine()
                ->getRepository(Category::class)->find($id);
            
                return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }
//method ("GET", "POST")
public function new(Request $request)
    {
        // creates a task and gives it some dummy data for this example
        $category = new Category();
        $category->setCategory();
        

        $form = $this->createFormBuilder($category)
            ->add('category', TextType::class)
            
            ->add('save', SubmitType::class, array('label' => 'Create category'))
            ->getForm();

        return $this->render('category/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    

}
