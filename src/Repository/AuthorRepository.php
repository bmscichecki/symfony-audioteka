<?php

namespace App\Repository;

use App\Entity\Author;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @method Author|null find($id, $lockMode = null, $lockVersion = null)
 * @method Author|null findOneBy(array $criteria, array $orderBy = null)
 * @method Author[]    findAll()
 * @method Author[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuthorRepository extends ServiceEntityRepository
{
    protected $container;
    public function __construct(RegistryInterface $registry, ContainerInterface $container)
    {
        parent::__construct($registry, Author::class);
        $this->container = $container;

    }

    // /**
    //  * @return Author[] Returns an array of Author objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Author
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findAllByAuthorName($request, $search_author)
    {
        $entityManager = $this->getEntityManager();
        $container = $this->container;

        $author = $entityManager->createQueryBuilder()
            ->select('a')
            ->from(Author::class, 'a')
            ->where("a.author_name LIKE :authorName")
            ->setParameter('authorName', $search_author.'%')
            ->orderBy('a.author_name', 'ASC')
            ->getQuery()
            ->getResult();

        $pagenator = $container->get('knp_paginator');
        $result = $pagenator->paginate(
            $author,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 5)
        );

        return $result;
    }
}
