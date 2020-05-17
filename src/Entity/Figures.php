<?php

namespace App\Entity;

use App\Repository\FiguresRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FiguresRepository::class)
 */
class Figures
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
    private $nomFigure;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image1;

     /**
     * @ORM\Column(type="string", length=255)
     */
    private $image2;
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $video;

    /**
     * @ORM\ManyToOne(targetEntity=Groupe::class, inversedBy="figures")
     * @ORM\JoinColumn(nullable=false)
     */
    private $groupe;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomFigure(): ?string
    {
        return $this->nomFigure;
    }

    public function setNomFigure(string $nomFigure): self
    {
        $this->nomFigure = $nomFigure;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImage1(): ?string
    {
        return $this->image1;
    }

    public function getImage2(): ?string
    {
        return $this->image2;
    }

    public function setImage1(string $image1): self
    {
        $this->image1 = $image1;

        return $this;
    }

    public function setImage2(string $image2): self
    {
        $this->image2 = $image2;

        return $this;
    }
    
    public function getVideo(): ?string
    {
        return $this->video;
    }

    public function setVideo(string $video): self
    {
        $this->video = $video;

        return $this;
    }

    public function getGroupe(): ?Groupe
    {
        return $this->groupe;
    }

    public function setGroupe(?Groupe $groupe): self
    {
        $this->groupe = $groupe;

        return $this;
    }
}
