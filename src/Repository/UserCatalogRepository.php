<?php

namespace App\Repository;

use App\Entity\UserCatalog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UserCatalog|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserCatalog|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserCatalog[]    findAll()
 * @method UserCatalog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserCatalogRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UserCatalog::class);
    }

    // /**
    //  * @return UserCatalog[] Returns an array of UserCatalog objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserCatalog
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
