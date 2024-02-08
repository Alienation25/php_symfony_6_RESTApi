<?php

namespace App\Repository;

use App\Entity\Author;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @extends ServiceEntityRepository<Author>
 *
 * @method Author|null find($id, $lockMode = null, $lockVersion = null)
 * @method Author|null findOneBy(array $criteria, array $orderBy = null)
 * @method Author[]    findAll()
 * @method Author[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuthorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Author::class);
    }

//    /**
//     * @return Author[] Returns an array of Author objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

    public function findOneBySomeField($value): ?Author
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.surname = :val')
            ->setParameter('val', $value)
            ->getQuery() // Получает объект Query из QueryBuilder, который будет использоваться для выполнения запроса
            ->getOneOrNullResult(); //Выполняет запрос и возвращает единственный результат или null, если ничего не найдено
    }

    public function getAll()
    {
        //"SELECT author, book FROM App\Entity\Author author INNER JOIN author.books book"
        $qb = $this->createQueryBuilder('author')//SELECT author FROM App\Entity\Author as author
                    ->select('author','book') //SELECT author, book FROM App\Entity\Author author
                    ->join('author.books', 'book'); //SELECT author, book FROM App\Entity\Author author INNER JOIN author.books book
        //join('author.books', 'book') - создает INNER JOIN между таблицей авторов (author) и таблицей книг (book) через ассоциацию books в сущности Author.
        //dd($qb->getDQL());
        $result = $qb->getQuery()->getResult();
        return $result;

    }
}
