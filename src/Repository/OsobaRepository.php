<?php

namespace App\Repository;

use App\Entity\Osoba;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Osoba>
 *
 * @method Osoba|null find($id, $lockMode = null, $lockVersion = null)
 * @method Osoba|null findOneBy(array $criteria, array $orderBy = null)
 * @method Osoba[]    findAll()
 * @method Osoba[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OsobaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Osoba::class);
    }

//    /**
//     * @return Osoba[] Returns an array of Osoba objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('o.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Osoba
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
