<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\VersionPost;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<VersionPost>
 *
 * @method VersionPost|null find($id, $lockMode = null, $lockVersion = null)
 * @method VersionPost|null findOneBy(array $criteria, array $orderBy = null)
 * @method VersionPost[]    findAll()
 * @method VersionPost[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VersionPostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VersionPost::class);
    }

//    /**
//     * @return VersionPost[] Returns an array of VersionPost objects
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

//    public function findOneBySomeField($value): ?VersionPost
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
