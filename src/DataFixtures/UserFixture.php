<?php

namespace App\DataFixtures;
use App\Entity\Assignexamtostudents;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;



class UserFixture extends BaseFixture
{
    private $passwordEncoder;
    private $entityManager;
    private $repository;
    private $user;
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    protected function loadData(ObjectManager $manager)
    {

      
      for ($i = 0; $i < 20; $i++)
      {
          $Astost = new Assignexamtostudents();
          $Astost->setExamid(1);
          $Astost->setStudentid(1);
          $Astost->setAssigndate(new \DateTime());
          $Astost->setStartrange(new \DateTime());
          $Astost->setEndrange(new \DateTime());



          $Astost->setSelecteddate(new \DateTime()) ;
          $Astost->setSelectedtime(new \DateTime());
          $Astost->setIsconfirmed(1);
          $Astost->setResult(0);
          $Astost->setShowtostudent(0);

         

          $manager->persist($Astost);
          $manager->flush();
        }
        

    }
}
