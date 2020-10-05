<?php

namespace App\Entity;

use App\Repository\VideoRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VideoRepository::class)
 */
class Video
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Regex(
     * pattern="#(?:https?:\/\/)?(?:www\.)?youtu\.?be(?:\.com)?\/?.*(?:watch|embed)?(?:.*v=|v\/|\/)([\w\-_]+)\&?#",
     * match=true,
     * message="Veuillez insérer un lien Youtube valide !"
     * )
     */
    private $videoName;

    /**
     * @ORM\ManyToOne(targetEntity=Figures::class, inversedBy="videos")
     */
    private $figure;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVideoName(): ?string
    {
        return $this->videoName;
    }

    public function setVideoName(?string $videoName): self
    {
        $this->videoName = $videoName;

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
