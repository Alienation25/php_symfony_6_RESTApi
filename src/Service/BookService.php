<?php

namespace App\Service;

use App\Entity\Author;
use App\Entity\Book;
use App\Repository\AuthorRepository;
use App\Repository\BookRepository;

use DateTimeImmutable;

use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class BookService extends AbstractController
{
    public function index(SerializerInterface $serializer ,BookRepository $bookRepository):Response
    {
        $result=$bookRepository->getAll();
        $jsonContent = $serializer->serialize($result,'json',['groups' => "book"]);
        $response = new Response($jsonContent);
        $response->headers->set('Content-Type', 'application/json; charset=utf-8');
        return $response;

    }

    public function create(AuthorRepository $authorRepository,EntityManagerInterface $entityManager,Request $request):JsonResponse
    {
        $image =$request->files->get('image');
        $data=json_decode($request->get('json'),true);
        $fileName = uniqid() . '.' . $image->guessExtension();
        $image->move( '/var/www/symfony1/public/images/books', $fileName);

        $book = new Book();
        $book->setTitle($data["contents"]["book"]["title"]);
        $book->setDescription($data["contents"]["book"]["description"]);
        $book->setPublish(DateTimeImmutable::createFromFormat('Y-m-d', $data['contents']['book']['createdAt']));
        $book->setImage($fileName);

        foreach ($data["contents"]["book"]["authors"] as $data ) {
            $author = $authorRepository->findOneBy([
                'surname'=>$data["surname"],
                'firstname'=>$data["firstName"],
                'patronymic'=>$data["patronymic"],
            ]);

            if (!$author)
            {
                $author = new Author();
                $author->setSurname($data["surname"]);
                $author->setFirstName($data["firstName"]);
                $author->setPatronymic($data["patronymic"]);
                $entityManager->persist($author);
            }

            $book->addAuthor($author);

        }
        $entityManager->persist($book);
        $entityManager->flush();
        return $this->json(['message' => 'Book created']);

    }

    public function show(BookRepository $bookRepository,int $id):JsonResponse
    {
        $data = $bookRepository->find($id);
        $jsonData = [
            'id' => $data->getId(),
            'title' => $data->getTitle(),
            'description' => $data->getDescription(),
            'image' => $data->getImage(),
            'publish' => $data->getPublish(),
            'Author' => [],
        ];
        foreach ($data->getAuthors() as $author){
            $jsonData['Author'][] =[
                "id"=>$author->getId(),
                "surname"=>$author->getSurname(),
                "fist_name"=>$author->getFirstName(),
                "patronymic"=>$author->getPatronymic(),
            ];
        }
        return $this->json($jsonData);

    }

    public function update(EntityManagerInterface $entityManager,Request $request, BookRepository $bookRepository, int $id):JsonResponse
    {
        $book = $bookRepository->find($id);
        $data = json_decode($request->getContent(), true);
        $book->setTitle($data['contents']['book']['title'] ?? $book->getTitle());
        $book->setDescription($data['contents']['book']['description'] ?? $book->getDescription());
        $book->setImage($data['contents']['book']['image'] ?? $book->getImage());
        $entityManager->persist($book);
        $entityManager->flush();
        return $this->json(['message' => 'Book update']);
    }
}