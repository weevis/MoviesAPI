<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

		/**
		 * @ORM\Column(type="string", length=255)
		 */
		private $name;

		/**
     * @ORM\Column(type="string", length=255)
     */
		private $password;

		/**
     * @ORM\Column(type="string", length=255)
     */
		private $email;

		/**
		 * @ORM\Column(type="string", length=255, nullable=True)
		 */
		private $api_token;

		public function getAPIToken()
		{
			return $this->api_token;
		}

		public function setAPIToken($token)
		{
			$this->api_token = $token;
		}

		public function getPassword()
		{
			return $this->password;
		}

		public function setPassword($password)
		{
			$this->password = $password;
		}

		public function getName()
		{
			return $this->name;
		}

		public function setName($name)
		{
			$this->name = $name;
		}

		public function getEmail()
		{
			return $this->email;
		}

		public function setEmail($email)
		{
			$this->email = $email;
		}

		public function getId()
		{
			return $this->id;
		}
}
