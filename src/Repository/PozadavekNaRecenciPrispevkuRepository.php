<?php

namespace App\Repository;

use App\Entity\PozadavekNaRecenciPrispevku;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PozadavekNaRecenciPrispevku>
 *
 * @method PozadavekNaRecenciPrispevku|null find($id, $lockMode = null, $lockVersion = null)
 * @method PozadavekNaRecenciPrispevku|null findOneBy(array $criteria, array $orderBy = null)
 * @method PozadavekNaRecenciPrispevku[]    findAll()
 * @method PozadavekNaRecenciPrispevku[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PozadavekNaRecenciPrispevkuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PozadavekNaRecenciPrispevku::class);
    }

//    /**
//     * @return PozadavekNaRecenciPrispevku[] Returns an array of PozadavekNaRecenciPrispevku objects
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

//    public function findOneBySomeField($value): ?PozadavekNaRecenciPrispevku
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
