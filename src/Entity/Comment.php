<?php

namespace Kader\CommentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: \Kader\CommentBundle\Repository\CommentRepository::class)]
class Comment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'text')]
    private ?string $content = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $author = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $context = null;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $createdAt = null;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }


    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        return $this->createdAt;
    }
    
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setAuthor(?string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setContext(?string $context): self
    {
        $this->context = $context;

        return $this;
    }

    public function getContext(): ?string
    {
        return $this->context;
    }

    public function __toString(): string
    {
        return $this->content;
    }
}
