<?php


namespace App\Controller;

use App\Entity\Author;
use App\Entity\Book;
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

    //Роут для перегляду списку всіх книг
    #[Route('api/books', methods: ['GET'])]
    public function indexBook(SerializerInterface $serializer ,BookRepository $bookRepository ):Response
    {
        $result=$bookRepository->getAll();
        $jsonContent = $serializer->serialize($result,'json',['groups' => "book"]);
        $response = new Response($jsonContent);
        $response->headers->set('Content-Type', 'application/json; charset=utf-8');
        return $response;

    }

    //Роут для створення книг
    #[Route('api/book/create', methods: ['POST'])]
    public function createBook(AuthorRepository $authorRepository,EntityManagerInterface $entityManager,Request $request): JsonResponse
    {
        $jsonContent = $request->getContent();
        $datas = json_decode($jsonContent, true);

        $book = new Book();
        $book->setTitle($datas["contents"]["book"]["title"]);
        $book->setDescription($datas["contents"]["book"]["description"]);
        $book->setImage($datas["contents"]["book"]["image"]);

        $createdAt = \DateTime::createFromFormat('Y-m-d', $datas['contents']['book']['createdAt']);
        $book->setCreatedAt($createdAt);

        foreach ($datas["contents"]["book"]["authors"] as $data ){
            $author = $authorRepository->findOneBy([
                'surname'=>$data["surname"],
                'firstname'=>$data["firstName"],
                'middlename'=>$data["middleName"],
                ]);

            if (!$author)
            {
                $author = new Author();
                $author->setSurname($data["surname"]);
                $author->setFirstName($data["firstName"]);
                $author->setMiddleName($data["middleName"]);
                $entityManager->persist($author);
            }

            $book->addAuthor($author);
        }
        $entityManager->persist($book);
        $entityManager->flush();

        return $this->json(['message' => 'Книга успешно создана']);
    }



    // Роут для перегляду однієї книги
    #[Route('api/book/{id}', methods: ['GET'])]
    public function showBook(BookRepository $bookRepository,int $id):JsonResponse
    {
        $data = $bookRepository->find($id);
        $jsonData = [
            'id' => $data->getId(),
            'title' => $data->getTitle(),
            'description' => $data->getDescription(),
            'image' => $data->getImage(),
            'created_at' => $data->getCreatedAt(),
            'Author' => [],
        ];
        foreach ($data->getAuthors() as $author){
            $jsonData['Author'][] =[
                "id"=>$author->getId(),
                "surname"=>$author->getSurname(),
                "first_name"=>$author->getFirstName(),
                "middle_name"=>$author->getMiddleName(),
            ];
        }
        return $this->json($jsonData);
    }







    // Роут для редагування книги
    #[Route('api/book/update/{id}',methods:['PUT'])]
    public function updateBook(EntityManagerInterface $entityManager,Request $request, BookRepository $bookRepository, int $id) : JsonResponse
    {
        $book = $bookRepository->find($id);
        $data = json_decode($request->getContent(), true);

        $book->setTitle($data['contents']['book']['title'] ?? $book->getTitle());
        $book->setDescription($data['contents']['book']['description'] ?? $book->getDescription());
        $book->setImage($data['contents']['book']['image'] ?? $book->getImage());

        $entityManager->persist($book);
        $entityManager->flush();

        return $this->json(['message' => 'Книга успешно обновлена']);

    }





}
