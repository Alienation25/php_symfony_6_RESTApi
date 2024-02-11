<?php

namespace App\Service;

use App\Entity\Author;
use App\Repository\AuthorRepository;

use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class AuthorService extends AbstractController
{
    public function __construct(protected SerializerInterface $serializer,protected EntityManagerInterface $entityManager,protected AuthorRepository $authorRepository)
    {
    }

    public function index(): Response
    {
        $result=$this->authorRepository->getAll();

        $jsonContent = $this->serializer->serialize($result,'json',['groups' => 'author']);

        $response = new Response($jsonContent);
        $response->headers->set('Content-Type', 'application/json; charset=utf-8');

         return $response;
    }

    public function create(Request $request): JsonResponse
    {
        $jsonContent = $request->getContent();

        $data = json_decode($jsonContent, true);

        $author = new Author();
        $author->setFirstName($data["contents"]["author"]["first_name"]);
        $author->setSurname($data["contents"]["author"]["surname"]);
        $author->setPatronymic($data["contents"]["author"]["middle_name"]);

        $this->entityManager->persist($author);
        $this->entityManager->flush();

        return $this->json(['message' => 'author create']);
    }

    public function show(Request $request): JsonResponse
    {
        $jsonContent = $request->getContent();

        $data = json_decode($jsonContent, true);
        $jsonData = [];

        $authors = $this->authorRepository->findAll();

        foreach ($authors as $author){
            if($author->getSurname() == $data["surname"])
            {
                foreach ($author->getBooks() as $book){
                    $jsonData[]=[
                        "id"=>$book->getId(),
                        "title"=>$book->getTitle(),
                        "description"=>$book->getDescription(),
                        "image"=>$book->getImage(),
                    ];
                }

            }
        }
        return $this->json($jsonData);
    }
}