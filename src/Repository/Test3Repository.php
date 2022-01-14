<?php

namespace App\Repository;

use App\Entity\Test3;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Test3|null find($id, $lockMode = null, $lockVersion = null)
 * @method Test3|null findOneBy(array $criteria, array $orderBy = null)
 * @method Test3[]    findAll()
 * @method Test3[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Test3Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Test3::class);
    }

    // /**
    //  * @return Test3[] Returns an array of Test3 objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Test3
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
