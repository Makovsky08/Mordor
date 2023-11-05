<?php

namespace App\Repository;

use App\Entity\Prispevek;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Prispevek>
 *
 * @method Prispevek|null find($id, $lockMode = null, $lockVersion = null)
 * @method Prispevek|null findOneBy(array $criteria, array $orderBy = null)
 * @method Prispevek[]    findAll()
 * @method Prispevek[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrispevekRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Prispevek::class);
    }

//    /**
//     * @return Prispevek[] Returns an array of Prispevek objects
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

//    public function findOneBySomeField($value): ?Prispevek
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
