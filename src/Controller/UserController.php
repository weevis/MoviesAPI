<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;

use App\Entity\User;

class UserController extends FOSRestController
{
    /**
     * @Route("/user", name="user")
     */
    public function index()
    {
        return $this->render('user/index.html.twig');
    }

		/**
		 * @Rest\Get("/api/user")
     */
		public function getUserList()
		{
			$result = $this->getDoctrine()->getRepository(User::class)->findAll();
			if( $result === null || empty($result) )
				return new View("No users found", Response::HTTP_NOT_FOUND);

			return $result;
		}

	  /**
     * @Rest\Get("api/user/{id}")
     */
		public function getUserById($id)
		{
			$singleResult = $this->getDoctrine()->getRepository(User::class)->findById($id);
			if( $singleResult === null || empty($singleResult))
				return new View("Not found", Response::HTTP_NOT_FOUND);

			return $singleResult;
		}


		private function createAPIToken()
		{
			$length = 15;
			return bin2hex(random_bytes($length));
		}

		/**
		 * @Rest\Post("/api/user/create")
		 */
		public function createUser(Request $request)
		{
			$user = new User();
			$name = $request->get('name');
			$password = $request->get('password');
			$email = $request->get('email');
			$api_token = $this->createAPIToken();

			if( empty($name) || empty($password) || empty($email) )
			{
				return new View("Please check you have supplied all information", Response::HTTP_NOT_ACCEPTABLE);
			}

			$user->setName($name);
			$user->setPassword(password_hash($password, PASSWORD_DEFAULT));
			$user->setEmail($email);
			$user->setAPIToken($api_token);

			$em = $this->getDoctrine()->getManager();
			$em->persist($user);
			$em->flush();

			$headers = array('Location' => '/api/user/' . $user->getId());
			return new View("Successfully added user.", Response::HTTP_CREATED, $headers);
		}

		/**
		 * @Rest\Post("/api/user/delete/{id}")
     */
		public function deleteUser($id)
		{
			$em = $this->getDoctrine()->getManager();
			$found = $this->getDoctrine()->getRepository(User::class)->findById($id);

			if(empty($found) )
			{
				return new View("No such user found.", Response::HTTP_NOT_FOUND);
			}
			else
			{
				$em->remove($found);
				$em->flush();
			}

			return new View("User deleted successfully.", Response::HTTP_OK);
		}
}
