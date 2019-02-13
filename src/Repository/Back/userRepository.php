<?php

namespace App\Repository\Back;

use App\Entity\Back\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method user|null find($id, $lockMode = null, $lockVersion = null)
 * @method user|null findOneBy(array $criteria, array $orderBy = null)
 * @method user[]    findAll()
 * @method user[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class userRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    // /**
    //  * @return user[] Returns an array of user objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?user
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
