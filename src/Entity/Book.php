<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;



#[ORM\Entity(repositoryClass: BookRepository::class)]
class Book
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['author','book'])]
    private ?int $id = null;


    //Назва. (Обов'язкове поле)
    #[ORM\Column(length: 255,nullable: false)]
    #[Groups(['author','book'])]
    private ?string $title = null;


    //Короткий опис. (Необов'язкове поле)
    #[ORM\Column(type: Types::TEXT,nullable: true)]
    #[Groups(['author','book'])]
    private ?string $description = null;



    // Зображення. (jpg або png, не більше 2 Мб, повинна зберігатися в окрему папку та мати унікальне ім'я файлу)
    #[ORM\Column(type: 'string', length: 255,unique: true)]
    #[Assert\File(
        maxSize: '2M',
        mimeTypes: ['image/jpeg', 'image/png'],
        mimeTypesMessage: 'Пожалуйста, загрузите изображение в формате jpg или png',
        uploadErrorMessage: 'Ошибка при загрузке файла'
    )]
    #[Groups(['author','book'])]
    private ?string $image = null;



    //Дата опублікування книги.
    #[ORM\Column(type: 'datetime',nullable: true)]
    #[Assert\DateTime]
    #[Groups(['author','book'])]
    protected \DateTime $createdAt;



    #[ORM\ManyToMany(targetEntity: Author::class, inversedBy: 'books')]
    #[Groups('book')]
    private Collection $authors;

    public function __construct()
    {
        $this->authors = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    /**
     * @return Collection<int, Author>
     */
    public function getAuthors(): Collection
    {
        return $this->authors;
    }

    public function addAuthor(Author $author): static
    {
        if (!$this->authors->contains($author)) {
            $this->authors->add($author);
        }

        return $this;
    }

    public function removeAuthor(Author $author): static
    {
        $this->authors->removeElement($author);

        return $this;
    }










    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }




}
