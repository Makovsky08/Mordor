<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\StatusPost;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<StatusPost>
 *
 * @method StatusPost|null find($id, $lockMode = null, $lockVersion = null)
 * @method StatusPost|null findOneBy(array $criteria, array $orderBy = null)
 * @method StatusPost[]    findAll()
 * @method StatusPost[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatusPostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StatusPost::class);
    }

//    /**
//     * @return StatusPost[] Returns an array of StatusPost objects
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

//    public function findOneBySomeField($value): ?StatusPost
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
