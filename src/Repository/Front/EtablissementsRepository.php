<?php

namespace App\Repository\Front;

use App\Entity\Front\etablissements;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Etablissements|null find($id, $lockMode = null, $lockVersion = null)
 * @method Etablissements|null findOneBy(array $criteria, array $orderBy = null)
 * @method Etablissements[]    findAll()
 * @method Etablissements[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class etablissementsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, etablissements::class);
    }

    // /**
    //  * @return Etablissements[] Returns an array of Etablissements objects
    //  */
    /*
    public function findByExampleField($value)
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
    public function findOneBySomeField($value): ?Etablissements
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
