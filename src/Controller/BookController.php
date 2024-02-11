<?php


namespace App\Controller;


use App\Service\BookService;
use App\Repository\AuthorRepository;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;


class BookController extends AbstractController
{
    public function __construct(protected BookService $bookService)
    {
    }

    #[Route('api/books', methods: ['GET'])]
    public function indexBook(): Response
    {
        return $this->bookService->index();
    }

    #[Route('api/book/create', methods: ['POST'])]
    public function createBook(Request $request): JsonResponse
    {
        return $this->bookService->create($request);
    }

    #[Route('api/book/{id}', methods: ['GET'])]
    public function showBook(int $id): JsonResponse
    {
       return $this->bookService->show($id);
    }

    #[Route('api/book/update/{id}',methods:['PUT'])]
    public function updateBook(Request $request, int $id): JsonResponse
    {
        return  $this->bookService->update($request,$id);
    }
}
