<?php

namespace App\Repository\Front;

use App\Entity\Front\questionType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method questionType|null find($id, $lockMode = null, $lockVersion = null)
 * @method questionType|null findOneBy(array $criteria, array $orderBy = null)
 * @method questionType[]    findAll()
 * @method questionType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class questionTypeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, questionType::class);
    }

    // /**
    //  * @return questionType[] Returns an array of questionType objects
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
    public function findOneBySomeField($value): ?questionType
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
