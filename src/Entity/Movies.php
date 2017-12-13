<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MoviesRepository")
 */
class Movies
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

		/**
		 * @ORM\Column(type="integer")
     */
		private $user_id;

	  /**
     * @ORM\Column(type="string", length=255)
     */
		private $name;

	  /**
     * @ORM\Column(type="integer")
     */
		private $year;

		/**
     * @ORM\Column(type="text")
     */
		private $description;

		/**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="movies")
     * @ORM\JoinColumn(nullable=true)
     */
		private $category;

    public function getCategory(): Category
    {
        return $this->category;
    }

    public function setCategory(Category $category)
    {
        $this->category = $category;
    }

		public function getName(): string
		{
			return $this->name;
		}

		public function setName(string $name)
		{
			$this->name = $name;
		}

		public function getYear(): integer
		{
			return $this->year;
		}

		public function setYear(integer $year)
		{
			$this->year = $year;
		}

		public function getDescription(): string
		{
			return $this->description;
		}

		public function setDescription(string $desc)
		{
			$this->description = $desc;
		}
	
}
