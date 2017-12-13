<?php

namespace App\Repository;

use App\Entity\Movies;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class MoviesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Movies::class);
    }

		public function findByName($name)
		{
			return $this->getEntityManager()->createQuery('SELECT * FROM Movies WHERE name = ?1')->setParameter(1, $name)->getResult();
		}

		public function findByUser($user_id)
		{
			return $this->getEntityManager()->createQuery('SELECT * FROM Movies WHERE user_id = ?1')->setParameter(1, $user_id)->getResult();
		}


    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('m')
            ->where('m.something = :value')->setParameter('value', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
