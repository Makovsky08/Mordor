<?php

namespace App\Repository;

use App\Entity\ResponseRequest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ResponseRequest>
 *
 * @method ResponseRequest|null find($id, $lockMode = null, $lockVersion = null)
 * @method ResponseRequest|null findOneBy(array $criteria, array $orderBy = null)
 * @method ResponseRequest[]    findAll()
 * @method ResponseRequest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResponseReviewRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ResponseRequest::class);
    }

//    /**
//     * @return ResponseRequest[] Returns an array of ResponseRequest objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ResponseRequest
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
