<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ImageRepository;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity(repositoryClass=ImageRepository::class)
 * @Vich\Uploadable
 * 
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
     * @Vich\UploadableField(mapping="figure_image", fileNameProperty="imageFigure")
     * @Assert\File(
     * maxSize="10000k",
     * maxSizeMessage="Le fichier excède 10000Ko.",
     * mimeTypes={"image/png", "image/jpeg", "image/jpg"},
     * mimeTypesMessage= "formats autorisés: png, jpeg, jpg"
     * )
     * @Assert\NotBlank(message="veuillez ajouter une image")
    */
    private $imageFile;

    /**
     * @ORM\ManyToOne(targetEntity=Figures::class, inversedBy="images")
     */
    private $figure;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

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

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageFile(?File $imageFile = null): self
    {
        $this->imageFile = $imageFile;
        
        if($this->imageFile instanceof UploadedFile){

            $this->updated_at = new \DateTime();
        }
        
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

}
