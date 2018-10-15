<?php

namespace App\Repository;

use App\Entity\Answers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Answers|null find($id, $lockMode = null, $lockVersion = null)
 * @method Answers|null findOneBy(array $criteria, array $orderBy = null)
 * @method Answers[]    findAll()
 * @method Answers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnswersRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Answers::class);
    }
 
   @return Answers[] Returns an array of Answers objects
    
    public function GetAllanswers($userid)
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = '
        SELECT 
            * from assignexamtostudents a where a.answersid= :uid';
            $stmt = $conn->prepare($sql);
            $stmt->execute(['uid' => $userid]);
    
        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();
    }
   
    
    */

    /*
    public function findOneBySomeField($value): ?Answers
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
