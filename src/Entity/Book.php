<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookRepository")
 */
class Book implements JsonSerializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\ManyToOne(targetEntity="Author")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id")
     */
    private $author;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $coverPicture;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $isbn;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creationDate;


    /**
     * @ORM\Column(type="array")
     */
    private $tags = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Author
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param Author $author
     */
    public function setAuthor($author): void
    {
        $this->author = $author;
    }
    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }


    public function getCoverPicture(): ?string
    {
        return $this->coverPicture;
    }

    public function setCoverPicture(string $coverPicture): self
    {
        $this->coverPicture = $coverPicture;

        return $this;
    }

    public function getIsbn(): ?string
    {
        return $this->isbn;
    }

    public function setIsbn(string $isbn): self
    {
        $this->isbn = $isbn;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTimeInterface $creationDate): self
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    public function getTags(): ?array
    {
        return $this->tags;
    }

    public function setTags(array $tags): self
    {
        $this->tags = $tags;

        return $this;
    }

    public function jsonSerialize() {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'author'=>  json_encode($this->author),
            'creationDate'=> $this->creationDate,
            'coverPicture'=> $this->coverPicture,
            'isbn' => $this->isbn,
            'tags' => $this->tags
        ] ;
    }
}
