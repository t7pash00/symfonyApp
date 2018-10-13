<?php

namespace App\Repository;

use App\Entity\Exams;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Exams|null find($id, $lockMode = null, $lockVersion = null)
 * @method Exams|null findOneBy(array $criteria, array $orderBy = null)
 * @method Exams[]    findAll()
 * @method Exams[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExamsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Exams::class);
    }

//    /**
//     * @return Exams[] Returns an array of Exams objects
//     */
    
    public function GetAllExams($userid):array{
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
          SELECT
          id,
          edescription,
          ecategory,
          CASE
          WHEN ecategory =1  THEN "Programming"
          WHEN ecategory =2  THEN "Math"
          WHEN ecategory =3  THEN "Finnish Languge"
          ELSE "No category is selected"
          END as qcategoryDsc,
          qdifficultylevel,
          CASE
          WHEN edifficultylevel =0  THEN "Easy"
          WHEN edifficultylevel =1  THEN "Medium"
          WHEN edifficultylevel =2  THEN "Hard"
          ELSE "No edifficultylevel is selected"
          END as edifficultylevelDsc,

          userid 
          FROM examss e
          WHERE e.userid = :userid
          ORDER BY e.qcategory
          ';
      $stmt = $conn->prepare($sql);
      $stmt->execute(['userid' => $userid]);
     // returns an array of arrays (i.e. a raw data set)
    return $stmt->fetchAll();
    }
    public function GetExamResultss($eid):array{
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT 
            id, examid, ansdescription,  iscorrect,
            CASE
            WHEN iscorrect =0  THEN "Wrong"
            WHEN iscorrect =1  THEN "Correct"
            END as iscorrectDsc
            FROM exams a
            WHERE a.examid= :eid
            ';
            $stmt = $conn->prepare($sql);
            $stmt->execute(['eid' => $eid]);
    
        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Exams
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
