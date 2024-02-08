<?php

namespace App\Entity;

use App\Repository\AuthorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;



#[ORM\Entity(repositoryClass: AuthorRepository::class)]
class Author
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['author','book'])]
    private ?int $id = null;


    // Прізвище (Обов'язкове поле, не коротше 3 символів)
    #[ORM\Column(length: 255 ,nullable: false)]
    #[Assert\Length(
        min: 3,
        minMessage: 'The nickname must contain at least {{ limit }} characters'
    )]
    #[Groups(['author','book'])]
    private ?string $surname = null;


    //Им'я (Обов'язкове)
    #[ORM\Column(length: 255,nullable: false)]
    #[Groups(['author','book'])]
    private ?string $firstname = null;


    //По-батькові (Необов'язкове)
    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['author','book'])]
    private ?string $middlename = null;



    #[ORM\ManyToMany(targetEntity: Book::class, mappedBy: 'authors')]
    #[Groups('author')]
    private Collection $books;

    public function __construct()
    {
        $this->books = new ArrayCollection();
    }


    /**
     * @return Collection<int, Book>
     */
    public function getBooks(): Collection
    {
        return $this->books;
    }

    public function addBook(Book $book): static
    {
        if (!$this->books->contains($book)) {
            $this->books->add($book);
            $book->addAuthor($this);
        }

        return $this;
    }

    public function removeBook(Book $book): static
    {
        if ($this->books->removeElement($book)) {
            $book->removeAuthor($this);
        }

        return $this;
    }



    public function getId(): ?int
    {
        return $this->id;
    }


    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): static
    {
        $this->surname = $surname;

        return $this;
    }



    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): void
    {
        $this->firstname = $firstname;
    }

    public function getMiddlename(): ?string
    {
        return $this->middlename;
    }

    public function setMiddlename(?string $middlename): void
    {
        $this->middlename = $middlename;
    }





}
