<?php

namespace App\Entity\Library;

use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Doctrine\Filter\DistinctFilter;
use App\Repository\Library\BookRepository;
use Doctrine\Common\Collections\Order;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: BookRepository::class)]
#[ApiResource(
    order: [
        'title' => 'asc'
    ],
    paginationItemsPerPage: 10)
]
#[ApiResource(
    shortName: 'Author',
    operations: [new GetCollection()],
    normalizationContext: ['groups' => ['author:read']],
    filters: [DistinctFilter::class],
    order: ['author' => 'asc'],
    paginationEnabled: false,
)]
#[GetCollection]
#[Get]
#[ApiFilter(
    SearchFilter::class,
    properties: [
        'title' => 'ipartial',
        'author1' => 'ipartial',
        'author2' => 'ipartial',
        'genre' => 'ipartial',
    ],
)]
#[ApiFilter(
    DistinctFilter::class,
    properties: [
        'distinct' => '',
    ],
)]
#[ApiFilter(
    OrderFilter::class,
    properties: [
        'title',
        'author1',
        'author2',
        'genre',
    ],
    arguments: [
        'orderParameterName' => 'order'
    ]
)]

class Book
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private string $title;

    #[Groups(['author:read'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $author1 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $author2 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $publisher = null;

    #[ORM\Column(nullable: true)]
    private ?int $copyright = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateOfPublication = null;

    #[ORM\Column(length: 10)]
    private ?string $isbn10 = null;

    #[ORM\Column(length: 13, nullable: true)]
    private ?string $isbn13 = null;

    #[ORM\Column(nullable: true)]
    private ?int $cost = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $bookCondition = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $bookFormat = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $awards = null;

    #[ORM\Column(nullable: true)]
    private ?int $bookNumber = null;

    #[Groups(['genre:read'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $genre = null;

    #[ORM\Column(type: "text", nullable: true)]
    private ?string $synopsis = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $notes = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $cover = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getAuthor1(): ?string
    {
        return $this->author1;
    }

    public function setAuthor1(?string $author1): static
    {
        $this->author1 = $author1;

        return $this;
    }

    public function getAuthor2(): ?string
    {
        return $this->author2;
    }

    public function setAuthor2(?string $author2): static
    {
        $this->author2 = $author2;

        return $this;
    }

    public function getPublisher(): ?string
    {
        return $this->publisher;
    }

    public function setPublisher(?string $publisher): static
    {
        $this->publisher = $publisher;

        return $this;
    }

    public function getCopyright(): ?int
    {
        return $this->copyright;
    }

    public function setCopyright(?int $copyright): static
    {
        $this->copyright = $copyright;

        return $this;
    }

    public function getDateOfPublication(): ?\DateTimeInterface
    {
        return $this->dateOfPublication;
    }

    public function setDateOfPublication(?\DateTimeInterface $dateOfPublication): static
    {
        $this->dateOfPublication = $dateOfPublication;

        return $this;
    }

    public function getIsbn10(): ?string
    {
        return $this->isbn10;
    }

    public function setIsbn10(string $isbn10): static
    {
        $this->isbn10 = $isbn10;

        return $this;
    }

    public function getIsbn13(): ?string
    {
        return $this->isbn13;
    }

    public function setIsbn13(?string $isbn13): static
    {
        $this->isbn13 = $isbn13;

        return $this;
    }

    public function getCost(): ?int
    {
        return $this->cost;
    }

    public function setCost(?int $cost): static
    {
        $this->cost = $cost;

        return $this;
    }

    public function getBookCondition(): ?string
    {
        return $this->bookCondition;
    }

    public function setBookCondition(?string $bookCondition): static
    {
        $this->bookCondition = $bookCondition;

        return $this;
    }

    public function getBookFormat(): ?string
    {
        return $this->bookFormat;
    }

    public function setBookFormat(?string $bookFormat): static
    {
        $this->bookFormat = $bookFormat;

        return $this;
    }

    public function getAwards(): ?string
    {
        return $this->awards;
    }

    public function setAwards(?string $awards): static
    {
        $this->awards = $awards;

        return $this;
    }

    public function getBookNumber(): ?int
    {
        return $this->bookNumber;
    }

    public function setBookNumber(?int $bookNumber): static
    {
        $this->bookNumber = $bookNumber;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(?string $genre): static
    {
        $this->genre = $genre;

        return $this;
    }

    public function getSynopsis(): ?string
    {
        return $this->synopsis;
    }

    public function setSynopsis(?string $synopsis): static
    {
        $this->synopsis = $synopsis;

        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): static
    {
        $this->notes = $notes;

        return $this;
    }

    public function getCover(): ?string
    {
        return $this->cover;
    }

    public function setCover(?string $cover): static
    {
        $this->cover = $cover;

        return $this;
    }
}
