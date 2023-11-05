<?php

namespace App\Repository;

use App\Entity\Reakce;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Reakce>
 *
 * @method Reakce|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reakce|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reakce[]    findAll()
 * @method Reakce[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReakceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reakce::class);
    }

//    /**
//     * @return Reakce[] Returns an array of Reakce objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Reakce
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
