<?php

namespace App\Repository\Front;

use App\Entity\Front\questionnaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method questionnaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method questionnaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method questionnaire[]    findAll()
 * @method questionnaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class questionnaireRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, questionnaire::class);
    }

    // /**
    //  * @return questionnaire[] Returns an array of questionnaire objects
    //  */
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
    public function findOneBySomeField($value): ?questionnaire
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
