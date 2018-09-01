<?php

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Book::class);
    }


    public function findByCreationDate($minDate, $maxDate, $authorNationality)
    {
        $qb = $this->createQueryBuilder('b')
            ->join('b.author', 'a')
            ->orderBy('b.id', 'ASC');

        if ($minDate) {
            $qb->andWhere('b.creationDate > :minDate')
                ->setParameter('minDate', $minDate);
        }

        if ($maxDate) {
            $qb->andWhere('b.creationDate < :maxDate')
                ->setParameter('maxDate', $maxDate);
        }

        if ($authorNationality) {
            $qb->andWhere('a.nationality = :authorNationality')
                ->setParameter('authorNationality', $authorNationality);
         }

        return $qb->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return Book[] Returns an array of Book objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Book
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
