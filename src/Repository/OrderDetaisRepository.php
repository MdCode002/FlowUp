<?php

namespace App\Repository;

use App\Entity\OrderDetais;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<OrderDetais>
 *
 * @method OrderDetais|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderDetais|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderDetais[]    findAll()
 * @method OrderDetais[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderDetaisRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderDetais::class);
    }

//    /**
//     * @return OrderDetais[] Returns an array of OrderDetais objects
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

//    public function findOneBySomeField($value): ?OrderDetais
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
