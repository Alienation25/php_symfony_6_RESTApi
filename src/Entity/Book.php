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
    private int $id;

    #[ORM\Column(type: Types::STRING, length: 50,nullable: false)]
    #[Groups(['author','book'])]
    private string $title;

    #[ORM\Column(type: Types::STRING,length: 50,nullable: true)]
    #[Groups(['author','book'])]
    private string $description;

    #[ORM\Column(type: Types::STRING, length: 50,unique: true)]
    #[Assert\File(
        maxSize: '2M',
        mimeTypes: ['image/jpeg', 'image/png'],
        mimeTypesMessage: 'Please upload the image in jpg or png format',
        uploadErrorMessage: 'Error uploading file'
    )]
    #[Groups(['author','book'])]
    private string $image;

    #[ORM\Column(type: Types::DATE_IMMUTABLE,nullable: true)]
    #[Groups(['author','book'])]
    protected \DateTimeImmutable $publish;

    #[ORM\ManyToMany(targetEntity: Author::class, inversedBy: 'books')]
    #[Groups('book')]
    private Collection $authors;

    public function __construct()
    {
        $this->authors = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection
     */
    public function getAuthors(): Collection
    {
        return $this->authors;
    }

    /**
     * @param Author $author
     * @return Author
     */
    public function addAuthor(Author $author): self
    {
        if (!$this->authors->contains($author)) {
            $this->authors->add($author);
        }

        return $this;
    }

    /**
     * @param Author $author
     * @return Author
     */
    public function removeAuthor(Author $author): self
    {
        $this->authors->removeElement($author);

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return string
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return string
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @param string $image
     * @return void
     */
    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getPublish(): \DateTimeImmutable
    {
        return $this->publish;
    }

    /**
     * @param \DateTimeImmutable $publish
     * @return void
     */
    public function setPublish(\DateTimeImmutable $publish): void
    {
        $this->publish = $publish;
    }
}
