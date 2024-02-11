<?php

namespace App\Controller;

use App\Service\AuthorService;
use App\Repository\AuthorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;


class AuthorController extends AbstractController
{
    public function __construct(protected AuthorService $authorService)
    {
    }

    #[Route('api/authors', methods: ['GET'])]
    public function indexAuthor(AuthorRepository $authorRepository,SerializerInterface $serializer) : Response
    {
        return $this->authorService->index($authorRepository,$serializer);
    }

    #[Route('api/author/create', methods: ['POST'])]
    public function createAuthor(EntityManagerInterface $entityManager,Request $request): JsonResponse
    {
        return  $this->authorService->create($entityManager,$request);
    }

    #[Route('api/author/book', methods: ['GET'])]
    public function showAuthor(Request $request,AuthorRepository $authorRepository):JsonResponse
    {
        return  $this->authorService->show($request,$authorRepository);
    }
}
