<?php

namespace App\Repository;

use App\Entity\Questions;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Questions|null find($id, $lockMode = null, $lockVersion = null)
 * @method Questions|null findOneBy(array $criteria, array $orderBy = null)
 * @method Questions[]    findAll()
 * @method Questions[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestionsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Questions::class);
    }
    /**
     * @return Questions[] Returns an array of Questions objects
     */
    public function GetAllQuestions($userid, $examid): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT
            q.id,
            q.qdescription,
            q.qcategory,
            CASE
            WHEN q.qcategory =1  THEN "Programming"
            WHEN q.qcategory =2  THEN "Math"
            WHEN q.qcategory =3  THEN "Finnish Languge"
            ELSE "No category is selected"
            END as qcategoryDsc,
            q.qdifficultylevel,
            CASE
            WHEN q.qdifficultylevel =0  THEN "Easy"
            WHEN q.qdifficultylevel =1  THEN "Medium"
            WHEN q.qdifficultylevel =2  THEN "Hard"
            ELSE "No qdifficultylevel is selected"
            END as qdifficultylevelDsc,
            q.canedit,
            q.userid
            FROM questions q ';

        if ($examid > 0) {
            $sql = $sql . '  INNER JOIN assignquestiontoexam ass ON q.id = ass.questionid
            WHERE q.userid = :userid and ass.examid=' . $examid . '  ORDER BY q.qcategory';
        } else {
            $sql = $sql . ' WHERE q.userid = :userid  ORDER BY q.qcategory';
        }
        $stmt = $conn->prepare($sql);
        $stmt->execute(['userid' => $userid]);
        // if ($examid>0)
        //   $stmt->execute(['examid' => $examid]);

        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();
    }

    public function GetQuestionAnswers($qid): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
                    SELECT
                    id, questionid, ansdescription,  iscorrect,
                    CASE
                    WHEN iscorrect =0  THEN "Wrong"
                    WHEN iscorrect =1  THEN "Correct"
                    END as iscorrectDsc
                    FROM answers a
                    WHERE a.questionid= :qid
                    ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['qid' => $qid]);

        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();
    }

//    /**
    //     * @return Questions[] Returns an array of Questions objects
    //     */
    /*
    public function findByExampleField($value)
    {
    return $this->createQueryBuilder('q')
    ->andWhere('q.exampleField = :val')
    ->setParameter('val', $value)
    ->orderBy('q.id', 'ASC')
    ->setMaxResults(10)
    ->getQuery()
    ->getResult()
    ;
    }
     */

    /*
public function findOneBySomeField($value): ?Questions
{
return $this->createQueryBuilder('q')
->andWhere('q.exampleField = :val')
->setParameter('val', $value)
->getQuery()
->getOneOrNullResult()
;
}
 */
}
