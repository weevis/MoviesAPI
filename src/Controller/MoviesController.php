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
use App\Entity\Movies;
use App\Entity\Category;

class MoviesController extends FOSRestController
{
    /**
     * @Route("/movies", name="movies")
     */
    public function index()
    {
        return new Response('Welcome to your new controller!');
    }

	  /**
		 * @Rest\Get("/api/movies")
		 */
		public function findAllMovies()
		{
			$movies = $this->getDoctrine()->getRepository(Movies::class)->findAll();

			if( $movies === null || empty($movies) )
			{
				return new View("No movies found.", Response::HTTP_NOT_FOUND);
			}
			return $movies;
		}

		/**
     * @Rest\Get("/api/movies/{name}")
     */
		public function getMovieByName($name)
		{
			$movie = $this->getDoctrine()->getRepository(Movies::class)->findByName($name);
			if($movie === null || empty($movie) )
			{
				return new View("Not found", Response::HTTP_NOT_FOUND);
			}
			return $movie;
		}

		/**
		 * @Rest\Post("/api/movies/add")
		 */
		public function addMovie(Request $request)
		{
		}

		/**
		 * @Rest\Put("/api/movies/{id}")
		 */
		public function updateMovie($id, Request $request)
		{
		}
}
