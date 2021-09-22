<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class Article
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbArticle;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isCheck;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getNbArticle(): ?int
    {
        return $this->nbArticle;
    }

    public function setNbArticle(?int $nbArticle): self
    {
        $this->nbArticle = $nbArticle;

        return $this;
    }

    public function getIsCheck(): ?bool
    {
        return $this->isCheck;
    }

    public function setIsCheck(bool $isCheck): self
    {
        $this->isCheck = $isCheck;

        return $this;
    }
}
