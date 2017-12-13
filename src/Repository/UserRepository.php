<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class UserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

		public function findById($id)
		{
			$query = $this->getEntityManager()->createQuery('SELECT u.name, u.email FROM App\Entity\User u WHERE u.id = ?1');
			$query->setParameter(1, $id);
			return $query->getResult();
		}

		public function findByKey($key)
		{
			$query = $this->getEntityManager()->createQuery('SELECT u.id, u.name, u.email FROM App\Entity\User u WHERE u.api_token = ?1');
			$query->setParameter(1, $id);
			return $query->getResult();
		}
}
