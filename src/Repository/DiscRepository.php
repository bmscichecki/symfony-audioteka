<?php

namespace App\Repository;

use App\Entity\Disc;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @method Disc|null find($id, $lockMode = null, $lockVersion = null)
 * @method Disc|null findOneBy(array $criteria, array $orderBy = null)
 * @method Disc[]    findAll()
 * @method Disc[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DiscRepository extends ServiceEntityRepository
{
    protected $container;
    public function __construct(RegistryInterface $registry, ContainerInterface $container)
    {
        parent::__construct($registry, Disc::class);
        $this->container = $container;

    }

    // /**
    //  * @return Disc[] Returns an array of Disc objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Disc
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findAllByDiscTitle($request, $search_title)
    {
        $entityManager = $this->getEntityManager();
        $container = $this->container;

        $disc = $entityManager->createQueryBuilder()
            ->select('d')
            ->from(Disc::class, 'd')
            ->where("d.title LIKE :discName")
            ->setParameter('discName', $search_title.'%')
            ->getQuery()
            ->getResult();

        $pagenator = $container->get('knp_paginator');
        $result = $pagenator->paginate(
            $disc,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 5)
        );

        return $result;
    }
}
