<?php

namespace App\Controller;

use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class ApiController extends AbstractController
{
    /**
     * @Route("/api", name="api")
     */
    public function index(Request $request, SerializerInterface $serializer, BookRepository $bookRepository)
    {
        $minDate = $request->query->get('minDate');
        $maxDate = $request->query->get('maxDate');
        $authorNationality = $request->query->get('authorNationality');

        $books = $bookRepository->findByCreationDate($minDate, $maxDate, $authorNationality);

        return new Response($serializer->encode($books, 'json'), 200, ['content-type' => 'application/json']);
    }
}
