<?php

namespace App\Repository;

use App\Entity\Card;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Card|null find($id, $lockMode = null, $lockVersion = null)
 * @method Card|null findOneBy(array $criteria, array $orderBy = null)
 * @method Card[]    findAll()
 * @method Card[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CardRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Card::class);
    }



    
    public function findAllCsv($user): array
    {
        return $this->createQueryBuilder('c')
            ->select('c.status_card','c.titre as intitule', 'c.description as description','c.ville as ville', 'c.email as email', 'c.telephone as telephone')
            ->andWhere('c.utilisateur = :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->getArrayResult()
        ;
    }
    
}
