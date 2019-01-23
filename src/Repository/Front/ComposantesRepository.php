<?php

namespace App\Repository\Front;

use App\Entity\Front\Composantes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Composantes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Composantes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Composantes[]    findAll()
 * @method Composantes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ComposantesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Composantes::class);
    }

    // /**
    //  * @return Composantes[] Returns an array of Composantes objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Composantes
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
