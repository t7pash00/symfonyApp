<?php

namespace App\DataFixtures;
use App\Entity\User;
use App\Entity\Questions;
use App\Entity\Answers;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;



class UserFixture extends BaseFixture
{
    private $passwordEncoder;
    private $entityManager;
    private $repository;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    protected function loadData(ObjectManager $manager)
    {

      for ($i = 0; $i < 20; $i++) {
                  $user = new User();
                  $em='s'.$i.'@student.fi';
                  $nam='student_'.$i;
                  $user->setEmail($em);
                  $user->setFirstName($nam);
                  $user->setPassword($this->passwordEncoder->encodePassword(
                            $user,
                            $nam
                        ));

                  $roles = array('ROLE_STUDENT');
                  $user->setRoles($roles);
                  $manager->persist($user);
              }

              for ($i = 0; $i < 10; $i++) {
                          $user = new User();
                          $em='t'.$i.'@teacher.fi';
                          $nam='teacher_'.$i;
                          $user->setEmail($em);
                          $user->setFirstName($nam);
                          $user->setPassword($this->passwordEncoder->encodePassword(
                                    $user,
                                    $nam
                                ));
                          $roles = array('ROLE_TEACHER');
                          $user->setRoles($roles);
                          $manager->persist($user);


                      }
                        $manager->flush();
                      $repository = $manager->getRepository(User::class);

                       $teacher = $repository->findOneBy(['firstName' => 'teacher_9']);

                      for ($i = 0; $i < 10; $i++) {
                                  $question = new Questions();
                                  $qDesc='Question Number '.$i;
                                  $question->setQdescription($qDesc);
                                  $question->setQcategory(mt_rand(1, 3));
                                  $question->setQdifficultylevel(mt_rand(0, 2));
                                  $question->setUserid($teacher->getId());
                                  $manager->persist($question);
                                  $manager->flush();
                                  // $repository1 = $manager->getRepository(Questions::class);
                                  //
                                  //  $questions = $repository->findOneBy(['firstName' => 'Question Number ']);
                                  for ($j = 1; $j < 5; $j++) {
                                              $answers = new Answers();
                                              $aDesc='Answer Number '.$j;

                                              $ansCor = mt_rand(1, 4);
                                              if ($ansCor==$j)
                                                $answers->setIscorrect(1);
                                              else {
                                                $answers->setIscorrect(0);
                                              }
                                              $answers->setAnsdescription($aDesc);
                                              $answers->setQuestionid($question->getId());
                                              $manager->persist($answers);


                                          }
                                            $manager->flush();
                              }





        // $this->createMany(10, 'main_users', function($i) {
        //     $user = new User();
        //     $user->setEmail(sprintf('spacebar%d@example.com', $i));
        //     $user->setFirstName($this->faker->firstName);
        //
        //     $user->setPassword($this->passwordEncoder->encodePassword(
        //         $user,
        //         'admin'
        //     ));
        //
        //     return $user;
        // });


    }
}
