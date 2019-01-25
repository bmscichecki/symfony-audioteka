<?php

namespace App\Repository;

use App\Entity\User;
use App\Entity\Disc;
use App\Entity\UserCatalog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @method UserCatalog|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserCatalog|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserCatalog[]    findAll()
 * @method UserCatalog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserCatalogRepository extends ServiceEntityRepository
{
    protected $container;
    public function __construct(RegistryInterface $registry, ContainerInterface $container)
    {
        parent::__construct($registry, UserCatalog::class);
        $this->container = $container;
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

    public function findAllByID($request,  $userId){
        $entityManager = $this->getEntityManager();
        $container = $this->container;

        $catalog = $entityManager->createQueryBuilder()
            ->select('c')
            ->from(UserCatalog::class, 'c')
            ->where('c.user_id = :userId')
            ->setParameter('userId', $userId)
            ->getQuery()
            ->getResult();

        $pagenator = $container->get('knp_paginator');
        $result = $pagenator->paginate(
            $catalog,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 5)
        );

        return $result;



    }

}
