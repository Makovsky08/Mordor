<?php

namespace App\Repository;

use App\Entity\VerzePrispevku;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<VerzePrispevku>
 *
 * @method VerzePrispevku|null find($id, $lockMode = null, $lockVersion = null)
 * @method VerzePrispevku|null findOneBy(array $criteria, array $orderBy = null)
 * @method VerzePrispevku[]    findAll()
 * @method VerzePrispevku[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VerzePrispevkuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VerzePrispevku::class);
    }

//    /**
//     * @return VerzePrispevku[] Returns an array of VerzePrispevku objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?VerzePrispevku
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
