<?php

namespace App\Repository;

use App\Entity\StageApprentissage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<StageApprentissage>
 *
 * @method StageApprentissage|null find($id, $lockMode = null, $lockVersion = null)
 * @method StageApprentissage|null findOneBy(array $criteria, array $orderBy = null)
 * @method StageApprentissage[]    findAll()
 * @method StageApprentissage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StageApprentissageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StageApprentissage::class);
    }

    public function findAllWithRelations()
    {
        return $this->createQueryBuilder('s')
            ->leftJoin('s.IdEtudiant', 'e')
            ->leftJoin('s.IdEntreprise', 'en')
            ->addSelect('e', 'en')
            ->getQuery()
            ->getResult();
    }

    //    /**
    //     * @return StageApprentissage[] Returns an array of StageApprentissage objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('s.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?StageApprentissage
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
