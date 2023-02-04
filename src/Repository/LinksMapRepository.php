<?php

namespace App\Repository;

use App\Entity\LinksMap;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<LinksMap>
 *
 * @method LinksMap|null find($id, $lockMode = null, $lockVersion = null)
 * @method LinksMap|null findOneBy(array $criteria, array $orderBy = null)
 * @method LinksMap[]    findAll()
 * @method LinksMap[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LinksMapRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LinksMap::class);
    }
    
    public function add(LinksMap $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(LinksMap $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    
    public function registerLink(string $name, string $originalLink): LinksMap
    {
        $entity = new LinksMap;
        $entity->setName($name);
        $entity->setOriginalLink($originalLink);
        
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
        
        $shortLinkSlug = base_convert($entity->getId(), 10, 36);
        $entity->setShortLinkSlag($shortLinkSlug);
        
        $this->getEntityManager()->flush();
        return $entity;
    }

//    /**
//     * @return LinksMap[] Returns an array of LinksMap objects
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

//    public function findOneBySomeField($value): ?LinksMap
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
