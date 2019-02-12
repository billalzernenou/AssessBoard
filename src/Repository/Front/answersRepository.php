<?php

namespace App\Repository\Front;

use App\Entity\Front\answers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method answers|null find($id, $lockMode = null, $lockVersion = null)
 * @method answers|null findOneBy(array $criteria, array $orderBy = null)
 * @method answers[]    findAll()
 * @method answers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class answersRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, answers::class);
    }

    // /**
    //  * @return answers[] Returns an array of answers objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?answers
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
