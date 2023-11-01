<?php

namespace App\Repository;

use App\Entity\Recenze;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Recenze>
 *
 * @method Recenze|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recenze|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recenze[]    findAll()
 * @method Recenze[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecenzeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recenze::class);
    }

//    /**
//     * @return Recenze[] Returns an array of Recenze objects
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

//    public function findOneBySomeField($value): ?Recenze
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
