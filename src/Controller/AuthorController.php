<?php

namespace App\Controller;

use App\Service\AuthorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class AuthorController extends AbstractController
{
    public function __construct(protected AuthorService $authorService)
    {
    }

    #[Route('api/authors', methods: ['GET'])]
    public function indexAuthor(): Response
    {
        return $this->authorService->index();
    }

    #[Route('api/author/create', methods: ['POST'])]
    public function createAuthor(Request $request): JsonResponse
    {
        return  $this->authorService->create($request);
    }

    #[Route('api/author/book', methods: ['GET'])]
    public function showAuthor(Request $request): JsonResponse
    {
        return  $this->authorService->show($request);
    }
}
