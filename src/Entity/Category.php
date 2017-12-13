<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

		/**
		 * @ORM\OneToMany(targetEntity="App\Entity\Movies", mappedBy="category")
     */
		private $movies;

		/**
		 * @ORM\Column(type="string", length=255)
		 */
		private $name;

		public function __construct()
		{
			$this->movies = new ArrayCollection();
		}

		/**
     * @return Collection|Movies[]
     */
		public function getMovies()
		{
			return $this->movies;
		}

		public function getName()
		{
			return $this->name;
		}

		public function setName($name)
		{
			$this->name = $name;
		}
}
