<?php

namespace App\Repository;

use App\Entity\Player;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Player|null find($id, $lockMode = null, $lockVersion = null)
 * @method Player|null findOneBy(array $criteria, array $orderBy = null)
 * @method Player[]    findAll()
 * @method Player[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlayerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Player::class);
    }

    /**
     * Recupére les joueurs recherchés via la barre de recherche
     * 
     * @return Player[] Returns an array of Performance objects
     * @param Player $player
     * @return array
     */
    public function searchPlayer($criteria) :?array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.name LIKE :val')
            ->setParameter('val', '%'.addcslashes($criteria, '%_').'%')
            ->orderBy('p.name', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
    
    /**
     * Recupére les joueurs recherchés via un formulaire de recherche avancé
     * 
     * @return Player[] Returns an array of Performance objects
     * @param Player $player
     * @return array
     */
    public function searchPlayerAdvanced($criteria) :?array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.position = :position')
            ->setParameter('position', $criteria['position'])
            ->andWhere('p.bestFoot = :bestFoot')
            ->setParameter('bestFoot', $criteria['bestFoot'])
            ->andWhere('p.weight >= :minWeight')
            ->setParameter('minWeight', $criteria['minWeight'])
            ->andWhere('p.weight <= :maxWeight')
            ->setParameter('maxWeight', $criteria['maxWeight'])
            ->andWhere('p.price >= :minPrice')
            ->setParameter('minPrice', $criteria['minPrice'])
            ->andWhere('p.price <= :maxPrice')
            ->setParameter('maxPrice', $criteria['maxPrice'])
            ->orderBy('p.price', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * Recupére la somme de matchs, passes décisives, buts, et temps de jeu des joueurs;
     *
     * @param Player $player
     * @return array
     */
    public function playerStats(Player $player) :?array
    {
        return $this->createQueryBuilder('p')
            ->innerJoin('p.performance', 'pf')
            ->addSelect('pf')
            ->andWhere('p.id = :id')
            ->setParameter('id', $player)
            ->select('p.id,
                p.name,
                p.current_team,
                COUNT(p.id) as matchs,
                SUM(pf.assist) as assists,
                SUM(pf.goal) as goals,
                SUM(pf.timePlayed) as times')
            ->getQuery()
            ->getOneOrNullResult();
    }
}
