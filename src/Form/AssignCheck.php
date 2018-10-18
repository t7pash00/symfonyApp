<?php
/**
 * Created by PhpStorm.
 * User: lassehav
 * Date: 20.8.2018
 * Time: 10.04
 */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class AssignCheck extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // $builder->add('name');
        // $builder->add('kk');
        // foreach ($options as $value) {
        //     $builder->add('aa', CheckboxType::class, array(
        //         'label'    => 'Show this entry publicly?',
        //         'required' => false,
        //         'value' => 1
        //     ));
        // }
        // $builder->add('aa', CheckboxType::class, array(
        //     'label'    => 'Show this entry publicly?',
        //     'required' => false,
        //     'value' => '1'
        // ));
    }

}