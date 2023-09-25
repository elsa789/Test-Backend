<?php

namespace App\Repository;

use App\Entity\Inspectors;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Inspectors>
 *
 * @method Inspectors|null find($id, $lockMode = null, $lockVersion = null)
 * @method Inspectors|null findOneBy(array $criteria, array $orderBy = null)
 * @method Inspectors[]    findAll()
 * @method Inspectors[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InspectorsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Inspectors::class);
    }

//    /**
//     * @return Inspectors[] Returns an array of Inspectors objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Inspectors
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
