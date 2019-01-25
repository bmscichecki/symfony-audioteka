<?php

namespace App\Repository;

use App\Entity\Genre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @method Genre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Genre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Genre[]    findAll()
 * @method Genre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GenreRepository extends ServiceEntityRepository
{
    protected $container;
    public function __construct(RegistryInterface $registry, ContainerInterface $container)
    {
        parent::__construct($registry, Genre::class);
        $this->container = $container;

    }

    // /**
    //  * @return Genre[] Returns an array of Genre objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Genre
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function getAll(): array {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            'SELECT genres FROM App\Entity\Genre genres'
        );
        return $query->execute();
    }

    public function findAllByGenreName($request, $search_genre)
    {
        $entityManager = $this->getEntityManager();
        $container = $this->container;

        $genre = $entityManager->createQueryBuilder()
            ->select('g')
            ->from(Genre::class, 'g')
            ->where("g.genre_name LIKE :genreName")
            ->setParameter('genreName', $search_genre.'%')
            ->orderBy('g.genre_name', 'ASC')
            ->getQuery()
            ->getResult();

        $pagenator = $container->get('knp_paginator');
        $result = $pagenator->paginate(
            $genre,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 5)
        );

        return $result;
    }
}
