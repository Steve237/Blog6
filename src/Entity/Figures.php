<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FiguresRepository")
 * @Vich\Uploadable
 * @UniqueEntity(
 *  fields={"nomFigure"},
 *  message="Une autre figure possède déjà ce titre, merci de le modifier"
 * )
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
     * @ORM\Column(type="string", length=100)
     * @Assert\Length(max=50, maxMessage="le titre doit contenir 50 caractères maximum!")
     * @Assert\NotBlank
     */
    private $nomFigure;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=5, minMessage="la description doit contenir au moins 5 caractères!")
     * @Assert\NotBlank
    */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Groupe::class, inversedBy="figures")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank
    */
    private $groupe;

    /**
     * @ORM\OneToMany(targetEntity=Image::class, mappedBy="figure", orphanRemoval=true)
     * @Assert\Valid()
    */
    private $images;

    /**
     * @ORM\OneToMany(targetEntity=Video::class, mappedBy="figure", orphanRemoval=true)
     * @Assert\Valid()
    */
    private $videos;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
    */
    private $imageTop;

    /**
     * @Vich\UploadableField(mapping="figure_image", fileNameProperty="imageTop")
     * 
     * @Assert\File(
     * maxSize="1000k",
     * maxSizeMessage="Le fichier excède 1000Ko.",
     * mimeTypes={"image/png", "image/jpeg", "image/jpg"},
     * mimeTypesMessage= "formats autorisés: png, jpeg, jpg"
     * )
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="figure", orphanRemoval=true)
     */
    private $comments;

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageFile(?File $imageFile = null): self
    {
        $this->imageFile = $imageFile;
        
        if($this->imageFile instanceof UploadedFile){

            $this->updated_at = new \DateTime('Now');
        }
        
        return $this;

    }

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->videos = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

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

    public function getGroupe(): ?Groupe
    {
        return $this->groupe;
    }

    public function setGroupe(?Groupe $groupe): self
    {
        $this->groupe = $groupe;

        return $this;
    }

    /**
    * @return Collection|Image[]
    */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setFigure($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->contains($image)) {
            $this->images->removeElement($image);
            // set the owning side to null (unless already changed)
            if ($image->getFigure() === $this) {
                $image->setFigure(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Video[]
     */
    public function getVideos(): Collection
    {
        return $this->videos;
    }

    public function addVideo(Video $video): self
    {
        if (!$this->videos->contains($video)) {
            $this->videos[] = $video;
            $video->setFigure($this);
        }

        return $this;
    }

    public function removeVideo(Video $video): self
    {
        if ($this->videos->contains($video)) {
            $this->videos->removeElement($video);
            // set the owning side to null (unless already changed)
            if ($video->getFigure() === $this) {
                $video->setFigure(null);
            }
        }

        return $this;
    }

    public function getImageTop(): ?string
    {
        return $this->imageTop;
    }

    public function setImageTop(?string $imageTop): self
    {
        $this->imageTop = $imageTop;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setFigure($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getFigure() === $this) {
                $comment->setFigure(null);
            }
        }

        return $this;
    }

}



