<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;
use App\Repository\AuthorRepository;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home_index", methods="GET")
     */
    public function index(BookRepository $bookRepository, AuthorRepository $authorRepository): Response
    {

        return $this->render('home/index.html.twig', ['books' => $bookRepository->findAll(), 'authors' => $authorRepository->findAll()]);
    }

}
