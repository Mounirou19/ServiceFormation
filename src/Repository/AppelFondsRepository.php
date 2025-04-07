<?php

namespace App\Repository;

use App\Entity\AppelFonds;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AppelFonds>
 *
 * @method AppelFonds|null find($id, $lockMode = null, $lockVersion = null)
 * @method AppelFonds|null findOneBy(array $criteria, array $orderBy = null)
 * @method AppelFonds[]    findAll()
 * @method AppelFonds[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AppelFondsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AppelFonds::class);
    }

//    /**
//     * @return AppelFonds[] Returns an array of AppelFonds objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?AppelFonds
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
