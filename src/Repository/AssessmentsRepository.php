<?php

namespace App\Repository;

use App\Entity\Assessments;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Assessments>
 *
 * @method Assessments|null find($id, $lockMode = null, $lockVersion = null)
 * @method Assessments|null findOneBy(array $criteria, array $orderBy = null)
 * @method Assessments[]    findAll()
 * @method Assessments[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AssessmentsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Assessments::class);
    }

//    /**
//     * @return Assessments[] Returns an array of Assessments objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Assessments
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
