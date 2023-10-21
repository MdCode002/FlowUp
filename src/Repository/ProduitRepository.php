<?php

namespace App\Repository;

use App\classe\search;
use App\Entity\Produit;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Produit>
 *
 * @method Produit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Produit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Produit[]    findAll()
 * @method Produit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Produit::class);
    }

//    /**
//     * @return Produit[] Returns an array of Produit objects
//     */
//    public function findByExampleField($value): array
//    {
//        C
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Produit
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    /**
     * Requete qui me permet de recuperer des produit en fonctoin de la recherche de l'utilisateur 
     *
     * @param search $search
     * @return Produit
     */
    public function findWithSearch(search $search){
        $query =  $this
        ->createQueryBuilder('p')
        ->select('c','p')
        ->join('p.category','c');
        
        if(!empty($search->categories)){
            $query  = $query 
            ->andWhere("c.id IN (:categories)")
            ->setParameter('categories',$search->categories);
        }
        if(!empty($search->string)){
            $query  = $query 
            ->andWhere("p.Nom LIKE :string")
            ->setParameter('string',"%{$search->string}%");
        }

        return $query->getQuery()->getResult();

    }
}
