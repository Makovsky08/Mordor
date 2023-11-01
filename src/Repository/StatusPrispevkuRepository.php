<?php

namespace App\Repository;

use App\Entity\StatusPrispevku;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<StatusPrispevku>
 *
 * @method StatusPrispevku|null find($id, $lockMode = null, $lockVersion = null)
 * @method StatusPrispevku|null findOneBy(array $criteria, array $orderBy = null)
 * @method StatusPrispevku[]    findAll()
 * @method StatusPrispevku[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatusPrispevkuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StatusPrispevku::class);
    }

//    /**
//     * @return StatusPrispevku[] Returns an array of StatusPrispevku objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?StatusPrispevku
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
