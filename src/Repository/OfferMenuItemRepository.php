<?php

namespace App\Repository;

use App\Entity\OfferMenuItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<OfferMenuItem>
 *
 * @method OfferMenuItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method OfferMenuItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method OfferMenuItem[]    findAll()
 * @method OfferMenuItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OfferMenuItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OfferMenuItem::class);
    }

    public function save(OfferMenuItem $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(OfferMenuItem $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return OfferMenuItem[] Returns an array of OfferMenuItem objects
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

//    public function findOneBySomeField($value): ?OfferMenuItem
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
