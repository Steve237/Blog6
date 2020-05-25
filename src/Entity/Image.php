<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ImageRepository::class)
 */
class Image
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageFigure;

    /**
     * @ORM\ManyToOne(targetEntity=Figures::class, inversedBy="images")
     */
    private $figure;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImageFigure(): ?string
    {
        return $this->imageFigure;
    }

    public function setImageFigure(?string $imageFigure): self
    {
        $this->imageFigure = $imageFigure;

        return $this;
    }

    public function getFigure(): ?Figures
    {
        return $this->figure;
    }

    public function setFigure(?Figures $figure): self
    {
        $this->figure = $figure;

        return $this;
    }
}
