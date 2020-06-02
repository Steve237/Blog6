<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UsersRepository;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=UsersRepository::class)
 * @UniqueEntity(
 * fields={"username"},
 * message="Ce pseudo existe déjà"
 * )
 * 
 * @UniqueEntity(
 * fields={"email"},
 * message="Cette adresse email existe déjà"
 * )
 */
class Users implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=5, max=10, minMessage="Il faut plus de 5 caractères", maxMessage="Il faut moins de 10 caractères")
     * @Assert\NotBlank(message="vous devez entrer votre pseudo")
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email(message="Vous devez rentrer une adresse email valide")
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=5, max=20, minMessage="Il faut plus de 5 caractères", maxMessage="Il faut moins de 20 caractères")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=5, max=20, minMessage="Il faut plus de 5 caractères", maxMessage="Il faut moins de 20 caractères")
     * @Assert\EqualTo(propertyPath="password", message="les mots de passe ne sont pas identiques")
     */
    private $verifpass;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $activation_token;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $reset_token;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getVerifpass(): ?string
    {
        return $this->verifpass;
    }

    public function setVerifpass(string $verifpass): self
    {
        $this->verifpass = $verifpass;

        return $this;
    }

    public function eraseCredentials()
    {

    }

    public function getSalt()
    {

    }

    public function getRoles()
    {
        return ['ROLE_USER'];
    }

    public function getActivationToken(): ?string
    {
        return $this->activation_token;
    }

    public function setActivationToken(?string $activation_token): self
    {
        $this->activation_token = $activation_token;

        return $this;
    }

    public function getResetToken(): ?string
    {
        return $this->reset_token;
    }

    public function setResetToken(?string $reset_token): self
    {
        $this->reset_token = $reset_token;

        return $this;
    }

}
